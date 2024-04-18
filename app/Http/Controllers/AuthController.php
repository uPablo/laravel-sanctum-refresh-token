<?php

namespace App\Http\Controllers;

use App\Enums\TokenAbility;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            "password" => bcrypt($request->password),
            "email" => $request->email
        ];

        $user = User::create($data);

        $accessToken = $user->createToken(
            'access_token',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.ac_expiration'))
        );

        $refreshToken = $user->createToken(
            'refresh_token',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.rt_expiration'))
        );

        return [
            'token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
        ];
    }

    /**
     * Login a user
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $accessToken = $user->createToken(
            'access_token',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.ac_expiration'))
        );

        $refreshToken = $user->createToken(
            'refresh_token',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.rt_expiration'))
        );

        return [
            'token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
        ];
    }

    /**
     * Refresh the access token
     *
     * @param Request $request
     * @return array
     */
    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken(
            'access_token',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.ac_expiration'))
        );

        return response([
            'message' => "Token généré",
            'token' => $accessToken->plainTextToken
        ]);
    }
}

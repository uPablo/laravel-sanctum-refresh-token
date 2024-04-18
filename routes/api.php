<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(
    'auth:sanctum',
    'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value
)->group(function () {
    Route::get('/auth/refresh-token', [
        AuthController::class, 'refreshToken'
    ]);
});

Route::middleware(
    'auth:sanctum',
    'ability:' . TokenAbility::ACCESS_API->value
)->get('/me', function (Request $request) {
    return $request->user();
});

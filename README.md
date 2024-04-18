# Sistema de Autenticação com Laravel Sanctum

Este projeto implementa um sistema robusto de autenticação utilizando Laravel Sanctum para gerenciar tokens de acesso e tokens de atualização. O sistema permite registrar e autenticar usuários, além de fornecer uma maneira segura de atualizar tokens de acesso expirados.

## Características

- Autenticação de usuários com tokens de acesso e atualização.
- Registração de novos usuários.
- Login e renovação de tokens.
- Uso de `enums` para definir capacidades específicas de tokens.

## Configuração

As configurações de Sanctum estão definidas para gerenciar as propriedades dos tokens, como expiração e capacidades, e estão documentadas no arquivo de configuração `sanctum.php`.

### Funções Principais

#### Registrar usuário

Registra um novo usuário no sistema, criando tokens de acesso e atualização com expirações configuráveis.

```php
public function register(Request $request)
{
    // Criação do usuário e dos tokens
}
```

#### Login

Autentica um usuário e emite novos tokens de acesso e atualização.

```php
public function login(Request $request)
{
    // Autenticação do usuário e emissão de tokens
}
```

#### Atualizar Token

Permite a atualização de tokens de acesso utilizando um token de atualização válido.

```php
public function refreshToken(Request $request)
{
    // Renovação do token de acesso
}
```

## Middleware de Verificação

Middleware são utilizados para assegurar que apenas tokens com as capacidades apropriadas sejam usados para acessar rotas específicas.

```php
// Definição de middleware para checagem de capacidades
```

## Roteamento

As rotas são protegidas utilizando middleware que verifica a autenticidade e a capacidade dos tokens.

```php
// Configuração de rotas API
```

## Execução

Para executar o projeto e testar as funcionalidades de autenticação:

1. Clone o repositório.
2. Configure seu ambiente `.env`.
3. Execute as migrações.
4. Teste utilizando Postman ou similar.

## Repositório GitHub

O código completo pode ser encontrado no GitHub através do link abaixo:

[Repositório GitHub](https://github.com/boko-marc/laravel-sanctum-refresh-token)

## Artigo de Referência

Este projeto foi baseado nas práticas descritas no artigo a seguir:

[Manage Refresh Token and Access Token with Laravel Sanctum](https://medium.com/@marcboko.uriel/manage-refresh-token-and-acces-token-with-laravel-sanctum-85defbce46ed)

## Contribuições

Contribuições são bem-vindas. Por favor, envie pull requests ou abra issues para sugestões de melhorias ou correções.

## Licença

Este projeto está licenciado sob a Licença MIT.

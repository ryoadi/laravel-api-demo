<?php

use function Pest\Laravel\postJson;

it('create a user', function () {
    $response = postJson('/api/auth/register', [
        'name' => 'user name',
        'email' => 'test@email.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSuccessful();
});

<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;

it('log user in', function () {
    $user = User::factory()->create();

    $response = postJson('/api/auth/login',  [
        'username' => $user->name,
        'password' => $user->password,
    ]);

    $response->assertOk();
});

it('validate input', function () {
    $response = postJson('/api/auth/login',  [
        'username' => 'user',
        'password' => 'pass',
    ]);

    $response->assertSuccessful();
});

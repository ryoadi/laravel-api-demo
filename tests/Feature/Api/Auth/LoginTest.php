<?php

use App\Models\User;

use function Pest\Laravel\postJson;

it('log user in', function () {
    $user = User::factory()->create();

    $response = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk();
});

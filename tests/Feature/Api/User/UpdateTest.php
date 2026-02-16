<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('update user profile', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->patchJson('/api/user', [
        'email' => 'email@test.com',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas('users', [
        'id' => $user->id,
        'email' => 'email@test.com',
    ]);
});

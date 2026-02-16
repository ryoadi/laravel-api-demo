<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

it('delete user', function () {
    $user = User::factory()->create();
    $id = $user->id;

    $response = actingAs($user)->deleteJson('/api/user');

    $response->assertSuccessful();
    assertDatabaseMissing('users', [
        'id' => $id,
    ]);
});

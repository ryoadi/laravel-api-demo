<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('update user profile', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->patchJson("/user", [
        'email' => 'email@test.com',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas(User::getTable(), [
        'id' => $user->id,
        'email' => 'email@test.com',
    ]);
});

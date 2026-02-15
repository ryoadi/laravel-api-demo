<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

it('delete user', function () {
    $user = User::factory()->create();
    $id = $user->id;

    $response = actingAs($user)->deleteJson('/user');

    $response->assertSuccessful();
    assertDatabaseMissing(Employment::getTable(), [
        'id' => $id,
    ])
});

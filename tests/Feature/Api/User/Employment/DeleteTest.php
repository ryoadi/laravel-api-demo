<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

it('delete employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->create();
    $id = $employment->id;

    $response = actingAs($user)->deleteJson("/user/job/{$id}");

    $response->assertSuccessful();
    assertDatabaseMissing(Employment::getTable(), [
        'id' => $id,
    ]);
});

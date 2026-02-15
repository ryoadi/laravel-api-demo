<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('update employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->create();

    $response = actingAs($user)->patchJson("/user/job/{$employment->id}", [
        'title' => 'test title',
        'description' => 'test description',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas(Employment::getTable(), [
        'id' => $employment->id,
        'title' => 'test title',
        'description' => 'test description',
    ]);
});

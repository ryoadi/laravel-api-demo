<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('create employment', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->postJson('/user/job/', [
        'title' => 'test title',
        'description' => 'test description',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas(Employment::getTable(), [
        'title' => 'test title',
        'description' => 'test description',
    ]);
});

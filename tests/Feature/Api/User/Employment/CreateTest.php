<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('create employment', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->postJson('/api/user/jobs', [
        'title' => 'test title',
        'description' => 'test description',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas('employments', [
        'title' => 'test title',
        'description' => 'test description',
    ]);
});

<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

test('example', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->postJson('/user/job/', [
        'title' => 'test title',
        'description' => 'test description',
    ]);

    $response->assertSuccessful();
});

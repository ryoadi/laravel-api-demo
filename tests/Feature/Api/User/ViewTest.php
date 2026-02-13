<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('return self profile', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->getJson('/api/user');

    $response->assertSuccessful();
});

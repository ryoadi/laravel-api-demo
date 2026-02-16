<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('display employment created by the user', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->for($user, 'created_by')->create();

    $response = actingAs($user)->getJson("/api/user/jobs/{$employment->id}");

    $response->assertSuccessful();
});

it('hide employment created by another user', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $employment = Employment::factory()->for($otherUser, 'created_by')->create();

    $response = actingAs($user)->getJson("/api/user/jobs/{$employment->id}");

    $response->assertNotFound();
});
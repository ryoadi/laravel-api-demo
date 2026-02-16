<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('update employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->create(['created_by_id' => $user->id]);

    $response = actingAs($user)->patchJson("/api/user/jobs/{$employment->id}", [
        'title' => 'test title',
        'description' => 'test description',
    ]);

    $response->assertSuccessful();
    assertDatabaseHas('employments', [
        'id' => $employment->id,
        'title' => 'test title',
        'description' => 'test description',
    ]);
});

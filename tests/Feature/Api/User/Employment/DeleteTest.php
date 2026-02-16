<?php

use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

it('delete employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()
        ->for($user, 'created_by')
        ->create();

    $response = actingAs($user)->deleteJson("/api/user/jobs/{$employment->id}");

    $response->assertSuccessful();
    assertDatabaseMissing('employments', [
        'id' => $employment->id,
    ]);
});

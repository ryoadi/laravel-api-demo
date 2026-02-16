<?php

use App\Enums\EmploymentStatusEnum;
use App\Models\Employment;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('publishes employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->create([
        'created_by_id' => $user->id,
        'status' => EmploymentStatusEnum::DRAFT,
    ]);

    $response = actingAs($user)->putJson("/api/user/jobs/{$employment->id}/published", []);

    $response->assertSuccessful();

    $employment->refresh();
    expect($employment->status)->toBe(EmploymentStatusEnum::PUBLISHED);
    expect($employment->published_at)->not->toBeNull();
});

it('cannot publish already published employment', function () {
    $user = User::factory()->create();
    $employment = Employment::factory()->create([
        'created_by_id' => $user->id,
        'status' => EmploymentStatusEnum::PUBLISHED,
    ]);

    $response = actingAs($user)->putJson("/api/user/jobs/{$employment->id}/published", []);

    $response->assertUnprocessable();
});

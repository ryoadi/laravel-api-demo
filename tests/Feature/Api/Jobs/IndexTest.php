<?php

use App\Enums\EmploymentStatusEnum;
use App\Models\Employment;

use function Pest\Laravel\getJson;

it('list published employments', function () {
    $employment = Employment::factory()->create(['status' => EmploymentStatusEnum::PUBLISHED]);

    $response = getJson('/api/jobs');

    $response->assertSuccessful();
});

it('hide non published employments', function () {
    $employment = Employment::factory()->create(['status' => EmploymentStatusEnum::ARCHIVED]);

    $response = getJson('/api/jobs');

    $response->assertSuccessful();
});
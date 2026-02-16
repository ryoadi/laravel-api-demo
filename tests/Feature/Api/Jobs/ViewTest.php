<?php

use App\Enums\EmploymentStatusEnum;
use App\Models\Employment;

use function Pest\Laravel\getJson;

it('show the published job', function () {
    $employment = Employment::factory()->create(['status' => EmploymentStatusEnum::PUBLISHED]);

    $response = getJson("/api/jobs/{$employment->id}");

    $response->assertSuccessful();
});

it('hide non published job', function () {
    $employment = Employment::factory()->create(['status' => EmploymentStatusEnum::DRAFT]);

    $response = getJson("/api/jobs/{$employment->id}");

    $response->assertNotFound();
});
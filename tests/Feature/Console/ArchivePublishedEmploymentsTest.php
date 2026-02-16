<?php

use App\Enums\EmploymentStatusEnum;
use App\Models\Employment;

it('archives published employments older than 1 month', function () {
    $oldEmployment = Employment::factory()->create([
        'status' => EmploymentStatusEnum::PUBLISHED,
        'published_at' => now()->subMonths(2),
    ]);

    $this->artisan('app:archive-published-employments')->assertExitCode(0);

    expect($oldEmployment->fresh()->status)->toBe(EmploymentStatusEnum::ARCHIVED);
});

it('does not archive published employments less than 1 month old', function () {
    $recentEmployment = Employment::factory()->create([
        'status' => EmploymentStatusEnum::PUBLISHED,
        'published_at' => now()->subWeeks(2),
    ]);

    $this->artisan('app:archive-published-employments')->assertExitCode(0);

    expect($recentEmployment->fresh()->status)->toBe(EmploymentStatusEnum::PUBLISHED);
});

it('does not archive draft employments', function () {
    $draftEmployment = Employment::factory()->create([
        'status' => EmploymentStatusEnum::DRAFT,
        'published_at' => now()->subMonths(2),
    ]);

    $this->artisan('app:archive-published-employments')->assertExitCode(0);

    expect($draftEmployment->fresh()->status)->toBe(EmploymentStatusEnum::DRAFT);
});

it('does not archive already archived employments', function () {
    $archivedEmployment = Employment::factory()->create([
        'status' => EmploymentStatusEnum::ARCHIVED,
        'published_at' => now()->subMonths(2),
    ]);

    $this->artisan('app:archive-published-employments')->assertExitCode(0);

    expect($archivedEmployment->fresh()->status)->toBe(EmploymentStatusEnum::ARCHIVED);
});

it('archives multiple employments', function () {
    Employment::factory(3)->create([
        'status' => EmploymentStatusEnum::PUBLISHED,
        'published_at' => now()->subMonths(2),
    ]);

    $this->artisan('app:archive-published-employments')->assertExitCode(0);

    $archivedCount = Employment::where('status', EmploymentStatusEnum::ARCHIVED)->count();

    expect($archivedCount)->toBe(3);
});

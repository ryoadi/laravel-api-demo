<?php

namespace App\Console\Commands;

use App\Enums\EmploymentStatusEnum;
use App\Models\Employment;
use Illuminate\Console\Command;

class ArchivePublishedEmploymentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-published-employments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive published employments that are older than 1 month';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $archivedCount = Employment::query()
            ->published()
            ->where('published_at', '<=', now()->subMonth())
            ->update(['status' => EmploymentStatusEnum::ARCHIVED]);

        $this->info("Archived {$archivedCount} employments.");

        return self::SUCCESS;
    }
}

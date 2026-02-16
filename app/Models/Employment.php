<?php

namespace App\Models;

use App\Enums\EmploymentStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employment extends Model
{
    /** @use HasFactory<\Database\Factories\EmploymentFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'created_by_id'];

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function casts()
    {
        return [
            'status' => EmploymentStatusEnum::class,
        ];
    }

    #[Scope]
    protected function published(Builder $query)
    {
        $query->where('status', EmploymentStatusEnum::PUBLISHED);
    }

    #[Scope]
    protected function forIndex(Builder $query, string $keyword = '', ?EmploymentStatusEnum $status = null)
    {
        $query
            ->when($status)->where('status', EmploymentStatusEnum::PUBLISHED)
            ->when($keyword)->where('title', 'LIKE', "%{$keyword}%");
    }
}

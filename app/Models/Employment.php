<?php

namespace App\Models;

use App\Enums\EmploymentStatusEnum;
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
}

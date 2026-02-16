<?php

namespace App\Http\Requests\User\Employment;

use App\Enums\EmploymentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QueryEmploymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'keyword' => 'filled|string',
            'status' => ['filled', Rule::enum(EmploymentStatusEnum::class)],
        ];
    }
}

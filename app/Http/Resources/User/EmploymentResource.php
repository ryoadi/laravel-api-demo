<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setData([
            'data' => $this->toArray($request),
            'link' => [
                'create' => url('/api/employments'),
                'update' => url("/api/employments/{$this->id}"),
                'delete' => url("/api/employments/{$this->id}"),
            ],
        ]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublishedEmploymentListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'created_by' => $this->getCreatorName(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'link' => url("/api/employments/{$this->id}"),
        ];
    }

    private function getCreatorName(): string
    {
        if ($this->relationLoaded('creator') && $this->creator) {
            return $this->creator->name;
        }

        return 'Unknown';
    }
}

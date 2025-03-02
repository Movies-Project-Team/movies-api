<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'name' => $this->name,
            'description' => $this->description,
            'produce_by' => $this->produce_by,
            'season' => $this->season,
            'lang' => $this->lang,
            'esp_total' => $this->esp_total,
            'year' => $this->year,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'poster' => $this->poster,
        ];
    }
}

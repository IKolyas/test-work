<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AdImageResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'priority' => $this->priority,
        ];
    }
}

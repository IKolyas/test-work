<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AdShowResource extends JsonResource
{

    public function toArray($request): array
    {
        $fields = [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->baseImage,
            'price' => $this->price,
        ];

        $requestFields = $request->get('fields');

        if (!is_array($requestFields) || empty($requestFields)) {
            return $fields;
        }

        foreach ($requestFields as $field) {

            if (!$this->$field) { abort(404, "field '$field' not exist"); }

            if ($this->$field) {
                $fields[$field] = $field === 'adImages'
                    ? AdImageResource::collection($this->adImages)
                    : $this->$field;
            }
        }

        return $fields;
    }
}

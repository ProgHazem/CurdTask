<?php

namespace App\Modules\LookUps\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class LookUpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'type' => 'lookUps',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'name' => $this->name ?? "",
            ]

        ];
    }
}

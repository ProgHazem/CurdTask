<?php

namespace App\Modules\Services\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use OpenApi\Annotations as OA;

class ServiceResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="ServiceResource",
     *     type="object",
     *     @OA\Property(property="type", type="string", example="service"),
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(
     *         property="attributes",
     *         type="object",
     *         @OA\Property(property="id", type="integer", example=1),
     *         @OA\Property(property="name", type="string", example="service"),
     *     )
     * )
     * 
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {


        return [
            'type' => 'service',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'name' => $this->name,
            ]
        ];
    }
}

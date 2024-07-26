<?php

namespace App\Modules\Auth\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class LoginAuthResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="LoginAuthResource",
     *     type="object",
     *     @OA\Property(property="type", type="string", example="User"),
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(
     *         property="attributes",
     *         type="object",
     *         @OA\Property(property="id", type="integer"),
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="email", type="string", format="email"),
     *         @OA\Property(property="created_at", type="string", format="date-time"),
     *         @OA\Property(property="updated_at", type="string", format="date-time")
     *     ),
     *     @OA\Property(property="relations", type="object")
     * )
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'type' => 'User',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relations' => []
        ];
    }
}

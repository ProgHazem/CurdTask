<?php

namespace App\Modules\Customers\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use OpenApi\Annotations as OA;

class CustomerResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="CustomerResource",
     *     type="object",
     *     @OA\Property(property="type", type="string", example="customer"),
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(
     *         property="attributes",
     *         type="object",
     *         @OA\Property(property="id", type="integer", example=1),
     *         @OA\Property(property="first_name", type="string", example="John"),
     *         @OA\Property(property="last_name", type="string", example="Doe"),
     *         @OA\Property(property="email", type="string", example="john.doe@example.com"),
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
            'type' => 'customer',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email'=>$this->email,
            ]
        ];
    }
}

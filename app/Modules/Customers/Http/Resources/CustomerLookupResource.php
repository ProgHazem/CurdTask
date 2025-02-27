<?php

namespace App\Modules\Customers\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use OpenApi\Annotations as OA;

class CustomerLookupResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="CustomerLockupResource",
     *     type="object",
     *     @OA\Property(property="type", type="string", example="customer"),
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(
     *         property="attributes",
     *         type="object",
     *         @OA\Property(property="id", type="integer", example=1),
     *         @OA\Property(property="name", type="string", example="John Doe"),
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
            'type' => 'customers',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'name'=>$this->first_name . ' ' . $this->last_name,
            ]
        ];
    }
}

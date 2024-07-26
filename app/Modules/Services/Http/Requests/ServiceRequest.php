<?php

namespace App\Modules\Services\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @OA\Schema(
     *     schema="ServiceRequest",
     *     type="object",
     *     required={"name"},
     *     @OA\Property(property="name", type="string", example="service"),
     *     @OA\Property(property="customer_id", type="integer", example="1"),
     * )
     */
    public function rules(): array
    {
        $serviceId = $this->route('service') ? $this->route('service')->id : null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $serviceId ? Rule::unique('services')->ignore($serviceId) : Rule::unique('services'),
            ],
            'customer_id' => 'required|integer|exists:customers,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('ServiceLocalization::validation.name.required'),
            'name.string' => trans('ServiceLocalization::validation.name.string'),
            'name.unique' => trans('ServiceLocalization::validation.name.unique'),
        ];
    }

}

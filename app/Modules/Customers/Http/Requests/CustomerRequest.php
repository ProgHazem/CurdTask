<?php

namespace App\Modules\Customers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class CustomerRequest extends FormRequest
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
     *     schema="CustomerRequest",
     *     type="object",
     *     required={"first_name", "last_name", "email"},
     *     @OA\Property(property="first_name", type="string", example="John"),
     *     @OA\Property(property="last_name", type="string", example="Doe"),
     *     @OA\Property(property="email", type="string", example="john.doe@example.com")
     * )
     */
    public function rules(): array
    {
        $customerId = $this->route('customer') ? $this->route('customer')->id : null;
        return [
            'first_name' => 'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers')->ignore($customerId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => trans('CustomerLocalization::validation.first_name.required'),
            'first_name.string' => trans('CustomerLocalization::validation.first_name.string'),
            'last_name.required' => trans('CustomerLocalization::validation.last_name.required'),
            'last_name.string' => trans('CustomerLocalization::validation.last_name.string'),
            'email.required' => trans('CustomerLocalization::validation.email.required'),
            'email.email' => trans('CustomerLocalization::validation.email.email'),
            'email.unique' => trans('CustomerLocalization::validation.email.unique'),
        ];
    }

}

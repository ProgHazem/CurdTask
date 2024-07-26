<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans('AuthLocalization::validation.email.required'),
            'email.string' => trans('AuthLocalization::validation.email.string'),
            'email.email' => trans('AuthLocalization::validation.email.email'),
            'password.required' => trans('AuthLocalization::validation.password.required'),
            'password.string' => trans('AuthLocalization::validation.password.string'),
            'password.regex' => trans('AuthLocalization::validation.password.regex'),
        ];
    }

}

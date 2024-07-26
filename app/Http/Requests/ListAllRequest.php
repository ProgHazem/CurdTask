<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListAllRequest extends FormRequest
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
            'page' => 'required|int|min:1',
            'per_page' => 'nullable|int|min:1',
            'search' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'page.required' => trans('general.page.required'),
            'page.int' => trans('general.page.number'),
            'page.min' => trans('general.page.min'),
            'per_page.int' => trans('general.per_page.number'),
            'per_page.min' => trans('general.per_page.min'),
            'search.string' => trans('general.search.string'),
        ];
    }

}

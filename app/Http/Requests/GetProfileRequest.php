<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'profile_id' => $this->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'profile_id.required' => 'The :attribute field is required.',
        ];
    }
}

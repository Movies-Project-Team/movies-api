<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'profile_id' => 'required',
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'profile_id.required' => 'The :attribute field is required.',
            'old_password.required' => 'The :attribute field is required.',
            'new_password.required' => 'The :attribute field is required.',
            'old_password.string' => 'The :attribute field is must string.',
            'new_password.string' => 'The :attribute field is must string.',
        ];
    }
}

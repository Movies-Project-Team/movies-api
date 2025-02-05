<?php

namespace App\Http\Requests;

use App\Rules\client\verifyPasswordProfile;
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
            'old_password' => ['required', 'string', 'size:4', new verifyPasswordProfile],
            'old_password_confirmation' => ['required', 'string', 'size:4', 'same:old_password'],
            'new_password' => ['required', 'string', 'size:4'],
        ];
    }

    public function messages()
    {
        return [
            'profile_id.required' => 'The :attribute field is required.',
            'old_password.required' => 'The :attribute field is required.',
            'old_password_confirmation.required' => 'The :attribute field is required.',
            'new_password.required' => 'The :attribute field is required.',
            'old_password.size' => 'The :attribute field must be exactly 4 letters.',
            'old_password_confirmation.size' => 'The :attribute field must be exactly 4 letters.',
            'new_password.size' => 'The :attribute field must be exactly 4 letters.',
            'old_password.string' => 'The :attribute field is must string.',
            'old_password_confirmation.string' => 'The :attribute field is must string.',
            'new_password.string' => 'The :attribute field is must string.',
            'old_password_confirmation.same' => 'The :attribute does not match the password.',
        ];
    }
}

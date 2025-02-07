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
            'profileId' => 'required',
            'oldPassword' => ['required', 'string', 'size:4', new verifyPasswordProfile()],
            'oldPasswordConfirmation' => ['required', 'string', 'size:4', 'same:old_password'],
            'newPassword' => ['required', 'string', 'size:4'],
        ];
    }

    public function messages()
    {
        return [
            'profileId.required' => 'The :attribute field is required.',
            'oldPassword.required' => 'The :attribute field is required.',
            'oldPasswordConfirmation.required' => 'The :attribute field is required.',
            'newPassword.required' => 'The :attribute field is required.',
            'oldPassword.size' => 'The :attribute field must be exactly 4 letters.',
            'oldPasswordConfirmation.size' => 'The :attribute field must be exactly 4 letters.',
            'newPassword.size' => 'The :attribute field must be exactly 4 letters.',
            'oldPassword.string' => 'The :attribute field is must string.',
            'oldPasswordConfirmation.string' => 'The :attribute field is must string.',
            'newPassword.string' => 'The :attribute field is must string.',
            'oldPasswordConfirmation.same' => 'The :attribute does not match the password.',
        ];
    }
}

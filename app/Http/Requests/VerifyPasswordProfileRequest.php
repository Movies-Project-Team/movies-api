<?php

namespace App\Http\Requests;

use App\Rules\client\verifyPasswordProfile;
use Illuminate\Foundation\Http\FormRequest;

class VerifyPasswordProfileRequest extends FormRequest
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
            'profile_id' => 'required',
            'password' => ['required', 'string', new verifyPasswordProfile()],
        ];
    }

    public function messages()
    {
        return [
            'profile_id.required' => 'The :attribute field is required.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute field is must string.',
        ];
    }
}

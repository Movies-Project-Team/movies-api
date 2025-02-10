<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOTPUserRequest extends FormRequest
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
            'userId' => 'required',
            'otp' => ['required', 'max:6'],
        ];
    }

    public function messages()
    {
        return [
            'userId.required'   => 'The :attribute field is required.',
            'password.required' => 'The :attribute field is required.',
            'password.string'   => 'The :attribute field is must string.',
        ];
    }
}

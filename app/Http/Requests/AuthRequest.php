<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];

        if($this->route()->getName() == 'auth.register') {
            $rules['email'] .= '|unique:users,email';
            $rules['password'] .= '|min:6';
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'email.required'    => 'The :attribute field is required.',
            'email.email'       => 'The :attribute field must be a valid email address.',
            'email.max'         => 'The :attribute field must be less than 255 characters.',
            'email.unique'      => 'The :attribute field has already been taken.',
            'password.required' => 'The :attribute field is required.',
            'password.min'      => 'The :attribute field must be at least 6 characters.',
        ];
    }
}

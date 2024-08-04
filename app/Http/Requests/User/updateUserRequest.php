<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'username' => 'required|string',
            'email' => 'required|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,ico|max:1024',
            'role_id' => 'required|exists:roles,id',
            'address' => 'nullable|string',
            'wallet_number' => 'nullable|string'
        ];
    }
}

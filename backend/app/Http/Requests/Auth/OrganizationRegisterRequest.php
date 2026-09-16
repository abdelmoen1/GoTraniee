<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
    return [
    'name' => ['required', 'string', 'max:255'],
    'organization_name' => ['required', 'string', 'max:255'],
    'organization_type' => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
    'password' => ['required', 'confirmed', 'min:8'],
];


    }
}

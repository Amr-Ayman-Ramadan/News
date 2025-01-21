<?php

namespace App\Http\Requests\EndUser\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'username' => 'required|string|max:255|unique:users|min:3',
            'phone' => 'required|string|max:255|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'username' => $this->checkUserNameValidation(),
            'phone' => $this->checkPhoneValidation(),
            'email' => $this->checkEmailValidation(),
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'in:active,inactive'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Validation rule for username.
     */
    protected function checkUserNameValidation(): string
    {
        if (request()->method() == 'PUT' || request()->method() == 'PATCH') {
            $userId = request('userId');
            return "required|string|max:255|unique:users,username,{$userId}";
        } else {
            return "required|string|max:255|unique:users,username";
        }
    }

    /**
     * Validation rule for phone.
     */
    protected function checkPhoneValidation(): string
    {
        if (request()->method() === 'PUT' || request()->method() == 'PATCH') {
            $userId = request('userId');
            return "required|unique:users,phone,{$userId}";
        } else {
            return "required|unique:users,phone";
        }
    }

    /**
     * Validation rule for email.
     */
    protected function checkEmailValidation(): string
    {
        if (request()->method() === 'PUT' || request()->method() == 'PATCH') {
            $userId = request('userId');
            return "required|email|unique:users,email,{$userId}";
        } else {
            return "required|email|unique:users,email";
        }
    }
}

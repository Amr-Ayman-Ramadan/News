<?php

namespace App\Http\Requests\Admin\admins;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "name" => ["required", "string", "max:255","min:3"],
            "username" => $this->checkUniqueUsername(),
            "email" => $this->checkUniqueEmail(),
            "password" => ["required", "string", "min:8", "confirmed"],
            "password_confirmation" => ["required", "string", "min:8"],
            "status" => ["required", "in:active,inactive"],
            "role_id" => ["required", "exists:roles,id"],
        ];
    }
    private function checkUniqueEmail()
    {
        if ( request()->method() === 'PUT') {
            $adminId = request("admin_id");
            return 'required|email|unique:admins,email,' . $adminId;
        }
        else{
            return 'required|email|unique:admins,email';
        }
    }
    private function checkUniqueUsername()
    {
        if ( request()->method() === 'PUT') {
            $adminId = request("admin_id");
            return 'required|unique:admins,username,' . $adminId;
        }
        else{
            return 'required|email|unique:admins,username';
        }
    }

}

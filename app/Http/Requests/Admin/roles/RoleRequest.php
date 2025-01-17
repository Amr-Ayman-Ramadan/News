<?php

namespace App\Http\Requests\Admin\roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            "name" => $this->nameUniqueValidate(),
            "permissions" => ["required", "array","min:1"],
            "permissions.*" => ["required", "string"]
        ];
    }
    public function nameUniqueValidate(): array
    {
        if ($this->isMethod('post')) {
            return ["required", "string", "max:255", "unique:roles,name", "min:3"];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $roleId = $this->route('role') ?? '0';

            return [
                "required",
                "string",
                "max:255",
                "min:3",
                \Illuminate\Validation\Rule::unique('roles', 'name')->ignore($roleId),
            ];
        }

        return ["required", "string", "max:255"];
    }

}

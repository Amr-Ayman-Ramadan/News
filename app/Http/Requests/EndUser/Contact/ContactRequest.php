<?php

namespace App\Http\Requests\EndUser\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name" => "required|string|min:3|max:255",
            "email" => "required|email",
            "phone" => "required|string|min:7|max:11|regex:/^([0-9\s\-\+\(\)]*)$/",
            "title" => "required|string|min:3|max:255",
            "body" => "required|string|min:3|max:255",
        ];
    }
}

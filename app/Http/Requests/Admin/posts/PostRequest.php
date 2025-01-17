<?php

namespace App\Http\Requests\Admin\posts;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title" => "required|string|min:3",
            "description"=>"required|string|min:10",
            'comment_able' => 'required|boolean',
            'status' => 'required|in:active,inactive',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image'=>$this->checkImageValidate()
        ];
    }

    public function checkImageValidate()
    {
        return request()->method() === 'POST'
            ? 'required|image|mimes:jpg,png,jpeg'
            : 'nullable|image|mimes:jpeg,png';
    }
}

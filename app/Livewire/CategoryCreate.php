<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $name;
    public $status;

    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name|min:3',
            'status' => 'required|in:active,inactive',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Category name is required.',
            'name.min' => 'Category name must be at least 3 characters.',
            'status.required' => 'Category status is required.',
            'status.in' => 'Category status must be active/inactive.',
        ];
    }

    public function saveCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->reset(['name', 'status']);
        toast('Category created!', 'success');
        return redirect(route('admin.categories.index'));
    }

    public function render()
    {
        return view('livewire.category-create');
    }
}

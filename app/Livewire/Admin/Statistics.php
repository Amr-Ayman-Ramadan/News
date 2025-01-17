<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {
        $categoriesCount = Category::where('status', "active")->count();
        $postsCount = Post::where('status', "active")->count();
        $commentsCount = Comment::count();
        $usersCount = User::whereStatus("active")->count();
        return view('livewire.admin.statistics', [
            "categoriesCount" => $categoriesCount,
            "postsCount" => $postsCount,
            "commentsCount" => $commentsCount,
            "usersCount" => $usersCount
        ]);
    }
}

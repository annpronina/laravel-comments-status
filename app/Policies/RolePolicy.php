<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{

    public function viewAny(User $user){
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function view(User $user, Post $post) {
        return $user->roles()->where('name', 'admin')->exists()  || $user->id === $post;
    }

    public function create(User $user) {
        return $user->roles()->where('name', 'editor')->exists() || $user->roles()->where('name', 'admin')->exists();
    }

    public function update(User $user, Post $post)
    {
        return $user->roles()->where('name', 'admin')->exists() || ($user->id === $post->user_id && $user->roles()->where('name', 'editor')->exists());
    }

    public function delete(User $user, Post $post) {
        return $user->roles()->where('name', 'admin')->exists();
    }
}
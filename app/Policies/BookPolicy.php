<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * @param  \App\Models\User  $user
     *
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     *
     * @return bool
     */
    public function view(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        if (!request()->isJson()) {
            return true;
        }
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     *
     * @return bool
     */
    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     *
     * @return bool
     */
    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

}

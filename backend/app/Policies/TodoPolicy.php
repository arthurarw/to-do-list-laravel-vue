<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TodoPolicy
 * @package App\Policies
 */
class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    /**
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    /**
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function destroy(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    /**
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function addTask(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}

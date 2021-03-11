<?php


namespace App\Services;


use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    public function update(User $user, array $input)
    {
        $checkEmail = User::where('email', $input['email'])->where('email', '<>', $user->email)->exists();

        if (!empty($input['email']) && $checkEmail) {
            throw new UserHasBeenTakenException();
        }

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $user->fill($input);
        $user->save();

        return $user->fresh();
    }

}

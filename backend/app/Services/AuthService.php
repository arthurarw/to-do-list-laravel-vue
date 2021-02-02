<?php


namespace App\Services;


use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws LoginInvalidException
     */
    public function login(string $email, string $password): array
    {
        $login = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth()->attempt($login)) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];
    }

    /**
     * @param array $data
     * @return mixed
     * @throws UserHasBeenTakenException
     */
    public function register(array $data)
    {
        $user = User::where('email', $data['email'])->exists();
        if (!empty($user)) {
            throw new UserHasBeenTakenException();
        }

        $userPassword = bcrypt($data['password'] ?? Str::random(10));

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'] ?? '',
            'email' => $data['email'],
            'password' => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);

        event(new UserRegistered($user));
        return $user;
    }
}

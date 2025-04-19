<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function dd;

class AuthService
{

    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function authenticate(string $email, string $password){
        $user = $this->userRepository->findByEmail($email);

        if(!$user){
            return [
                'status' => false,
                'message' => 'Email or password is not correct'
            ];
        }

        if(!$user->is_active){
            return [
                'status' => false,
                'message' => 'Your account is deactivated, please contact administrator'
            ];
        }

        if(!Hash::check ($password,$user->password)){
            return [
                'status' => false,
                'message' => 'Email or password is not correct'
            ];
        }

        Auth::login($user);

        return [
            'status' => true,
            'message' => 'Login success'
        ];
    }

    public function register (array $data)
    {
        $user = $this->userRepository->createUser ($data);

        if(!$user){
            return [
                'status' => false,
                'message' => 'Cannot create user'
            ];
        }
        return [
            'status' => true,
            'message' => 'Register success'
        ];
    }
}

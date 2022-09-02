<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    /**
     * @param string $username
     * @param string $userEmail
     * @param int $websiteId
     * @return void
     */
    public function subscribe(string $username, string $userEmail, int $websiteId): User
    {
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            $user = $this->createUser($username, $userEmail);
        }
        $user->websites()->attach($websiteId);
        return $user;
    }


    public function createUser($name,$email,$password = null) : User
    {
        return user::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}

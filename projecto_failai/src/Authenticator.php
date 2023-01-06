<?php

namespace tstauras83;

use tstauras83\Exceptions\UnauthenticatedException;

class Authenticator
{

    public function __construct()
    {

    }

    public function authenticate(string|null $username, string|null $password): bool
    {
        return $this->isLoggedIn() || !empty($username) && !empty($password) && $this->login($username, $password);
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['logged']) && $_SESSION['logged'] === true;
    }

    /**
     * @param string $checkUser
     * @param string $checkPass
     * @return bool
     * @throws UnauthenticatedException
     */
    public function login(string $checkUser, string $checkPass): bool
    {
        $loginData = [
            'admin' => 'admin',
            'Tauras' => 'Sem',
        ];

        foreach ($loginData as $username => $pass) {
            if ($checkUser === $username && $checkPass === $pass) {
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $checkUser ?? $_SESSION['username'];
                return true;
            }
        }
        return false;
    }
}
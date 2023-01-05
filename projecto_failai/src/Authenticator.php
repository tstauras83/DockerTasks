<?php

namespace tstauras83;

class Authenticator
{

    public function __construct(){

    }
    public function authenticate(mixed $username, mixed $password): bool
    {
        return (isset($_SESSION['logged']) && $_SESSION['logged'] === true) || ($username == 'admin' && $password == 'admin');
    }
}
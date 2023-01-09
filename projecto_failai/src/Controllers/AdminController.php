<?php

namespace tstauras83\Controllers;


use tstauras83\Authenticator;
use tstauras83\Exceptions\UnauthenticatedException;
use tstauras83\FS;

class AdminController
{
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator = null)
    {
        $this->authenticator = $authenticator ?? new Authenticator();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function index()
    {
        if (!$this->authenticator->isLoggedIn()) {
            throw new UnauthenticatedException();
        }

        return 'ADMIN puslapis';
//        $render = new HtmlRender($output);
//        $render->render();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function login(): void
    {
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if(!empty($userName) && !empty($password)) {
            $this->authenticator->login($userName, $password);
            header('Location: /admin');
        }
    }


    public function logout(): string
    {
        $this->authenticator->logout();
        return '';
    }
}
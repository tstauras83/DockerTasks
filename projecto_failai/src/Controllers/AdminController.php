<?php

namespace tstauras83\Controllers;


use tstauras83\Authenticator;
use tstauras83\Exceptions\UnauthenticatedException;
use tstauras83\FS;
use tstauras83\Response;

class AdminController extends BaseController
{
    private Authenticator $authenticator;
    // BAD PRACTICE: DI metu priskirti numatytasias (Default) reiksmes
    public function __construct(Authenticator $authenticator = null)
    {
        $this->authenticator = $authenticator ?? new Authenticator();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function index(): Response
    {
        if (!$this->authenticator->isLoggedIn()) {
            throw new UnauthenticatedException();
        }

        return new Response('ADMIN puslapis');
//        $render = new HtmlRender($output);
//        $render->render();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function login()
    {
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if(!empty($userName) && !empty($password)) {
            $this->authenticator->login($userName, $password);
            header('Location: /admin');
        }
    }


    public function logout()
    {
        $this->authenticator->logout();
        return '';
    }
}
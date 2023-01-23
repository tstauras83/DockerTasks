<?php

namespace tstauras83\Controllers;


use tstauras83\Authenticator;
use tstauras83\Exceptions\UnauthenticatedException;
use tstauras83\FS;
use tstauras83\Response;
use tstauras83\Request;

class AdminController extends BaseController
{
    private Authenticator $authenticator;

    // BAD PRACTICE: DI metu priskirti numatytasias (Default) reiksmes
    public function __construct(Authenticator $authenticator = null)
    {
        $this->authenticator = $authenticator ?? new Authenticator();
        parent::__construct();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function index(Request $request): Response
    {
        if (!$this->authenticator->isLoggedIn()) {
            throw new UnauthenticatedException();
        }

        return $this->response([
            'message' => $request->get('message'),
            'content' => 'Admin puslapis! ' . $_SESSION['username'],
        ]);
//        $render = new HtmlRender($output);
//        $render->render();
    }

    /**
     * @throws UnauthenticatedException
     */
    public function login(Request $request): Response
    {
        $userName = $request->get('username');
        $password = $request->get('password');

        if (!empty($userName) && !empty($password)) {
            $this->authenticator->login($userName, $password);

        }
        return $this->redirect('/admin', 'Sveikiname prisijungus');
    }


    public function logout(): Response
    {
        $this->authenticator->logout();

        return $this->redirect('/', ['message' => 'Sveikiname atsijungus']);
    }
}
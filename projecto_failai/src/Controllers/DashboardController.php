<?php

namespace tstauras83\Controllers;

use tstauras83\HTMLRender;
use tstauras83\Response;


class DashboardController extends BaseController
{
    private HTMLRender $render;

    public function __construct(HTMLRender $render)
    {
        $this->render = $render;
    }

    /**
     * @throws \Exception
     */
    public function index(): Response
    {
        $data = [
            'username' => $_SESSION['username'],
            'userType' => 'Admin',
            'loggedInDate' => date('Y-m-d H:i:s'),
            'error' => 'has to return error',
        ];
        return new Response($this->render->render('../src/html/dashboard.html', $data));
    }
}
<?php

namespace tstauras83\Controllers;

use tstauras83\Response;
use tstauras83\FS;

class StartController extends BaseController
{
    public function index(): Response
    {
        // Nuskaitomas HTML failas ir siunciam jo teksta i Output klase
        $fileSystem = new FS('../src/html/start.html');
        $fileContents = $fileSystem->getFileContents();
        foreach ($_REQUEST as $key => $item) {
            $fileContents = str_replace("{{$key}}", $item, $fileContents);
        }
        return new Response($fileContents);
    }
}
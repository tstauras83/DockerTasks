<?php

namespace tstauras83\Controllers;

use tstauras83\Response;
use tstauras83\FS;
use tstauras83\Request;

class StartController extends BaseController
{
    public function index(Request $request): Response
    {
        // Nuskaitomas HTML failas ir siunciam jo teksta i Output klase
        $fileSystem = new FS('../src/html/start.html');
        $fileContents = $fileSystem->getFileContents();
        foreach ($request->all() as $key => $item) {
            $fileContents = str_replace("{{$key}}", $item, $fileContents);
        }
        return $this->Response($fileContents);
    }
}
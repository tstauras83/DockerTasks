<?php

namespace tstauras83\Controllers;

use tstauras83\FS;

class StartController
{
    public function index()
    {
        // Nuskaitomas HTML failas ir siunciam jo teksta i Output klase
        $fileSystem = new FS('../src/html/start.html');
        $fileContents = $fileSystem->getFileContents();
        foreach ($_REQUEST as $key => $item) {
            $fileContents = str_replace("{{$key}}", $item, $fileContents);
        }
        return $fileContents;
    }
}
<?php

namespace tstauras83\Controllers;

use tstauras83\FS;

class StartController
{
    public function index(): string
    {
        $fileSystem = new FS('../src/html/start.html');
        $fileContents = $fileSystem->getFileContents();
        return $fileContents;

    }
}
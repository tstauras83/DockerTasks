<?php

namespace tstauras83\Controllers;


use tstauras83\FS;

class AdminController
{
    public function index(): string
    {
        $fileSystem = new FS('../src/html/admin.html');
        $fileContents = $fileSystem->getFileContents();
        return $fileContents;
    }
}
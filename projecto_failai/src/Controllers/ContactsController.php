<?php

namespace tstauras83\Controllers;

use tstauras83\FS;

class ContactsController
{

    public function __construct()
    {
    }

    public function index()
    {
        $fileSystem = new FS('../src/html/contacts.html');
        $fileContents = $fileSystem->getFileContents();
        return $fileContents;
    }
}
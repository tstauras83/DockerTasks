<?php

namespace tstauras83\Controllers;

use tstauras83\FS;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
class ContactsController
{
    private Logger $log;

    public function __construct(Logger $log)
    {
    $this->log = $log;
    }


    public function index()
    {
        $fileSystem = new FS('../src/html/contacts.html');
        $fileContents = $fileSystem->getFileContents();
        $this->log->warning('Contacts Page Vsisited');

        return $fileContents;
    }


}
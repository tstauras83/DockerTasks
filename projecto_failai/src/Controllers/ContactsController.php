<?php

namespace tstauras83\Controllers;

use tstauras83\FS;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use tstauras83\Response;

class ContactsController extends BaseController
{
    private Logger $log;

    public function __construct(Logger $log)
    {
    $this->log = $log;
    }


    public function index(): Response
    {
        $fileSystem = new FS('../src/html/contacts.html');
        $fileContents = $fileSystem->getFileContents();
        $this->log->warning('Contacts Page Vsisited');

        return new Response($fileContents);
    }


}
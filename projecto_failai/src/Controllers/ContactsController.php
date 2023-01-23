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
        parent::__construct();
    }

    public function index(): Response
    {
        // Nuskaitomas HTML failas ir siunciam jo teksta i Output klase
        $fileSystem = new FS('../src/html/contacts.html');
        $fileContents = $fileSystem->getFileContents();
        $this->log->info('Kontaktai atidaryti');

        return $this->response($fileContents);
    }
}
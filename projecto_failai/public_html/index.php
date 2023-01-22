<?php

use tstauras83\ExceptionHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use tstauras83\Authenticator;
use tstauras83\Controllers\AdminController;
use tstauras83\Controllers\ContactsController;
use tstauras83\Controllers\PersonController;
use tstauras83\Controllers\StartController;
use tstauras83\Exceptions\RenderingDashboardException;
use tstauras83\Exceptions\UnauthenticatedException;
use tstauras83\Output;
use tstauras83\Router;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/larapack/dd/src/helper.php';

$log = new Logger('Portfolio');
$log->pushHandler(new StreamHandler('../logs/errors.log', Logger::WARNING));

$output = new Output();

try {
    session_start();

    $authenticator = new Authenticator();
    $adminController = new AdminController($authenticator);
    $contactController = new ContactsController($log);

    $router = new Router();
    $router->addRoute('GET', '', [new StartController(), 'index']);
    $router->addRoute('GET', 'admin', [$adminController, 'index']);
    $router->addRoute('POST', 'login', [$adminController, 'login']);
    $router->addRoute('GET', 'contacts', [$contactController, 'index']);
    $router->addRoute('GET', 'person', [new PersonController(), 'index']);
    $router->addRoute('GET', 'person/new', [new PersonController(), 'new']);
    $router->addRoute('GET', 'person/edit', [new PersonController(), 'edit']);
    $router->addRoute('POST', 'person/update', [new PersonController(), 'update']);
    $router->addRoute('GET', 'person/delete', [new PersonController(), 'delete']);
    $router->addRoute('GET', 'person/view', [new PersonController(), 'view']);
    $router->addRoute('POST', 'person', [new PersonController(), 'store']);
    $router->addRoute('GET', 'logout', [$adminController, 'logout']);
    $router->run();
}
catch (Exception $e) {
    $handler = new ExceptionHandler($output, $log);
    $handler->handle($e);
}



// Spausdinam viska kas buvo 'Storinta' Output klaseje
$output->print();




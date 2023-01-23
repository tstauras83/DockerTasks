<?php

use tstauras83\Controllers\AddressController;
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

$log = new Logger('Portfolios');
$log->pushHandler(new StreamHandler('../logs/klaidos.log', Logger::INFO));

$output = new Output();

try {
    session_start();

    $authenticator = new Authenticator();
    $adminController = new AdminController($authenticator);
    $contactController = new ContactsController($log);
    $personController = new PersonController();
    $addressController = new AddressController();

    $router = new Router($output);
    $router->addRoute('GET', '', [new StartController(), 'index']);
    $router->addRoute('GET', 'admin', [$adminController, 'index']);
    $router->addRoute('POST', 'login', [$adminController, 'login']);
    $router->addRoute('GET', 'logout', [$adminController, 'logout']);
    $router->addRoute('GET', 'contacts', [$contactController, 'index']);
    $router->addRoute('GET', 'person', [$personController, 'index']);
    $router->addRoute('GET', 'person/new', [$personController, 'new']);
    $router->addRoute('GET', 'person/delete', [$personController, 'delete']);
    $router->addRoute('GET', 'person/edit', [$personController, 'edit']);
    $router->addRoute('GET', 'person/view', [$personController, 'view']);
    $router->addRoute('POST', 'person', [$personController, 'store']);
    $router->addRoute('POST', 'person/update', [$personController, 'update']);

    $router->addRoute('GET', 'address', [$addressController, 'index']);
    $router->addRoute('GET', 'address/new', [$addressController, 'new']);
    $router->addRoute('GET', 'address/delete', [$addressController, 'delete']);
    $router->addRoute('GET', 'address/edit', [$addressController, 'edit']);
    $router->addRoute('GET', 'address/view', [$addressController, 'view']);
    $router->addRoute('POST', 'address', [$addressController, 'store']);
    $router->addRoute('POST', 'address/update', [$addressController, 'update']);
    $router->run();
}
catch (Exception $e) {
    $handler = new ExceptionHandler($output, $log);
    $handler->handle($e);
}




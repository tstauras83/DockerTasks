<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use tstauras83\Controllers\AdminController;
use tstauras83\Controllers\ContactsController;
use tstauras83\Controllers\PortfolioController;
use tstauras83\Controllers\StartController;
use tstauras83\Exceptions\RenderingDashboardException;
use tstauras83\Exceptions\UnauthenticatedException;
use tstauras83\Output;
use tstauras83\Router;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "/../vendor/larapack/dd/src/helper.php";

// create a log channel
$log = new Logger('Portfolio');
$log->pushHandler(new StreamHandler('../Logs/errors.log', Logger::WARNING));

$output = new Output();


try {
    session_start();

//    // Autentifikuojam vartotoja, tikrinam jo prisijungimo busena
//    $authenticator = new Authenticator();
//    $authenticator->authenticate($_POST['username'] ?? null, $_POST['password'] ?? null);

    $router = new Router();
    $router->addRoute('GET', '', [new StartController(), 'index']);
    $router->addRoute('GET', 'admin', [new AdminController(), 'index']);
    $router->addRoute('GET', 'contacts', [new ContactsController(), 'index']);
    $router->addRoute('GET', 'portfolio', [new PortfolioController(), 'index']);
    $router->run();


}
catch (\tstauras83\Exceptions\PageNotFoundException $e) {
    $output->store('Page Not Found');
    $log->warning($e->getMessage());
}catch(RenderingDashboardException $e){
    $output->store('Error Showing Dashboard');
    $log->error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
}catch (UnauthenticatedException $e) {
    $output->store('Error');
    $log->warning($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
}catch (Exception $e) {
    $output->store('Error');
    $log->error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
}

$output->print();





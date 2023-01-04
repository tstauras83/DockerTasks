<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


require __DIR__ . '/../vendor/autoload.php';



// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('Test.log', Logger::WARNING));

$log->warning('Foo');
$log->error('Bar');
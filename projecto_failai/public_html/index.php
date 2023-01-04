<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


require __DIR__ . '/../vendor/autoload.php';


// create a log channel
$log = new Logger('Portfolio');
$log->pushHandler(new StreamHandler('../Logs/errors.log', Logger::WARNING));



try {

    $i = 0;
    if ($i=1){
        throw new exception('is not 0');
    }else{
        throw new exception('is 0');
    }


} catch (Exception $e) {
    echo $e;
    $log->error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
}
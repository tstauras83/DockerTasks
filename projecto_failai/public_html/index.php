<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use tstauras83\FS;
use tstauras83\Output;


require __DIR__ . '/../vendor/autoload.php';


// create a log channel
$log = new Logger('Portfolio');
$log->pushHandler(new StreamHandler('../Logs/errors.log', Logger::WARNING));

$output = new Output();

try {
    session_start();

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if($_GET['logout'] ?? false) {
        $_SESSION['logged'] = false;
        session_destroy();
    }

    if(
        isset($_SESSION['logged']) && $_SESSION['logged'] === true || ($username === 'admin' && $password === 'admin')) {
        $_SESSION['logged'] = true;
        $fileSystem = new FS('../src/html/dashboard.html');
        $fileContents = $fileSystem->getFileContents();
        $fileContents = str_replace('<h4>Welcome User! ...</h4><br>', '<h4>Welcome ' . $username . '! ...</h4><br>', $fileContents);
        $output->store($fileContents);

    }else{
        $fileSystem = new FS('../src/html/start.html');
        $fileContents = $fileSystem->getFileContents();
        $output->store($fileContents);
        if ($username !== null && $password !== null) {
            $output->store('Wrong username or password');
        }
    }
} catch (Exception $e) {
    $output->store('Error');
    $log->error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
}



$output->print();









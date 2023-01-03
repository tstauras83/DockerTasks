<?php

//Admin, EmailClient, Logger
require_once '../src/Admin.php';


$admin = new Admin();

// send an email
$admin->sendEmail('john@example.com', 'Hello', 'Hello, how are you?');

// retrieve the inbox
$inbox = $admin->getInbox();


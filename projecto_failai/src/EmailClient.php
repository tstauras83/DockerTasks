<?php

// EmailClient interface
interface EmailClient {
    public function sendEmail($to, $subject, $message);
    public function getInbox();
}
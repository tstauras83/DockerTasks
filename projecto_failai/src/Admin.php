<?php

// include the EmailClient and Logger classes into Admin
include_once 'EmailClient.php';
include_once 'Logger.php';


class Admin implements EmailClient {
    use Logger;

    public function sendEmail($to, $subject, $message) {
        // send email using some implementation
        // log the sent message using the log() method of the Logger trait
        $this->log("Sent email to $to with subject '$subject' and body '$message'");
    }

    public function getInbox() {
        $inbox = array(
        );
        // retrieve inbox using some implementation
        // log the retrieved messages using the log() method of the Logger trait
        $this->log("Retrieved email");
        return $inbox;
    }
}
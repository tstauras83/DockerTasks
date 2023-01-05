<?php

namespace tstauras83;

use tstauras83\FS;

class HTMLRender extends AbstractRender
{
    protected function getContent(): string {
        $fileSystem = new FS('../src/html/dashboard.html');
        $fileContents = $fileSystem->getFileContents();
        $userData = [
            'username' => $_SESSION['username'],
            'userType' => 'Admin',
            'loggedInDate' => date('Y-m-d H:i:s'),
        ];
        foreach ($userData as $key => $value) {
            $fileContents = str_replace('{{' . $key . '}}',  $value, $fileContents);
        }
        return $fileContents;
    }
}
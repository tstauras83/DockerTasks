<?php

namespace tstauras83;

use Exception;
use tstauras83\FS;

class HTMLRender extends AbstractRender
{
    /**
     * @throws Exception
     */
    protected function getContent(): string {
        $fileSystem = new FS('../src/html/dashboard.html');
        $fileContents = $fileSystem->getFileContents();
        $userData = [
            'username' => $_SESSION['username'],
            'userType' => 'Admin',
            'loggedInDate' => date('Y-m-d H:i:s'),
            'error' => 'has to return error',
        ];
        foreach ($userData as $key => $value) {
            $fileContents = str_replace('{{' . $key . '}}',  $value, $fileContents);
        }
        $keys = ['error', 'username', 'userType', 'loggedInDate'];
        $notFound = [];

        foreach ($keys as $key) {
            if (!str_contains($fileContents, $userData[$key])) {
                $notFound[] = $key;
            }
        }
        if (!empty($notFound)) {
            throw new Exception('The following keys were not found in dashboard.html: ' . implode(', ', $notFound));
        }
        return $fileContents;
    }
}
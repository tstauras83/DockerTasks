<?php

namespace tstauras83\Controllers;

use tstauras83\FS;

class PortfolioController
{


    public function index()
    {
        $fileSystem = new FS('../src/html/portfolio.html');
        $fileContents = $fileSystem->getFileContents();
        return $fileContents;
    }
}
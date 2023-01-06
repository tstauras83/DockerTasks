<?php

namespace tstauras83\Exceptions;

use Exception;

class UnauthenticatedException extends Exception
{


    public function __construct()
    {
        parent::__construct('Unauthorized', 401);
    }
}
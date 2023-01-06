<?php

namespace tstauras83\Exceptions;

use Exception;

class RenderingDashboardException extends Exception
{
    public function __construct()
    {
        parent::__construct('Dashboard Rendering Error', 401);
    }
}
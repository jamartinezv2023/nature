<?php

namespace App\Presentation\Controllers;

class DashboardController
{
    public function index()
    {
        require __DIR__
            . '/../../../public/views//dashboard';
    }
}

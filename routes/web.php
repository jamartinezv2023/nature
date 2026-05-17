<?php

use App\Presentation\Controllers\AuthController;
use App\Presentation\Controllers\DashboardController;

return [

    '/' => [AuthController::class, 'index'],

    '/login' => [AuthController::class, 'login'],

    '/dashboard' => [DashboardController::class, 'index'],

];

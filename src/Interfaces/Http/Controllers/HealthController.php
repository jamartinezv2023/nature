<?php

namespace App\Interfaces\Http\Controllers;

use App\Shared\Helpers\Response;

class HealthController
{
    public function index(): void
    {
        Response::json([
            'success' => true,
            'application' => 'Ecosistema Nature',
            'environment' => $_ENV['APP_ENV'],
            'timestamp' => date('Y-m-d H:i:s'),
            '_links' => [
                'self' => [
                    'href' => '/api/v1/health'
                ]
            ]
        ]);
    }
}

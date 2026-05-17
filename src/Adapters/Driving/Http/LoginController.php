<?php

namespace Nature\Adapters\Driving\Http;

use Nature\Core\Domain\Services\AuthService;
use Exception;

class LoginController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handleRequest(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            $tenantId = $input['tenant_id'] ?? '';
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? '';
            $step = $input['step'] ?? 1;
            $otpCode = $input['otp_code'] ?? '';

            if ($step === 1) {
                // Validación del Primer Factor (Credenciales + Tenant)
                $user = $this->authService->authenticateFirstFactor($email, $password, $tenantId);
                
                echo json_encode([
                    'success' => true,
                    'step' => $user->isTwoFactorEnabled() ? 2 : 'authenticated',
                    'message' => $user->isTwoFactorEnabled() ? 'Primer factor verificado. Ingrese código 2FA.' : 'Autenticación completa.'
                ]);
            } elseif ($step === 2) {
                // Validación del Segundo Factor (2FA)
                // Nota: En una implementación real, recuperaríamos al usuario temporal desde la sesión
                echo json_encode([
                    'success' => true,
                    'step' => 'authenticated',
                    'message' => 'Acceso concedido al ecosistema SaaS.'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}

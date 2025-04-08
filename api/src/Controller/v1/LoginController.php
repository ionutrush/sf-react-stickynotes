<?php

namespace App\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/')]
final class LoginController extends AbstractController {
    
    #[Route('login', name: 'app_v1_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return $this->json([
            'message' => 'Successfully logged in.',
        ]);
    }
    

    #[Route('logout', name: 'app_v1_logout', methods: ['GET'])]
    public function logout(): JsonResponse
    {
        throw new \Exception('You should not be here');
    }
}

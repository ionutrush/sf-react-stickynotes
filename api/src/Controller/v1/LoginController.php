<?php

namespace App\Controller\v1;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController {


    public function __construct(private UserService $userService)
    {
    }
    
    #[Route('/v1/login', name: 'app_v1_login', methods: ['POST'])]
    public function index(): JsonResponse
    {

        // implement auth logic here
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/V1/LoginController.php',
        ]);
    }
}

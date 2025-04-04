<?php

namespace App\Controller\v1;

use App\DTO\UserRegistrationRequest;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class UserController extends AbstractController {


    public function __construct(
        private UserService $userService
    )
    {
    }

    #[Route('/v1/register', name: 'app_v1_register', methods: ['POST'])]
    public function register(#[MapRequestPayload] UserRegistrationRequest $registrationData): JsonResponse
    {
        try {
            $user = $this->userService->register($registrationData->getEmail(), $registrationData->getPassword());

            return $this->json([
                'id' => $user->getId(),
                'email' => $user->getEmail(),
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Registration failed.',
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

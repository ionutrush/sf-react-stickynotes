<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function login(string $email, string $password): User
    {

        // Fetch the user by email
        $user = $this->findOneByEmail($email);

        // Check if the user exists
        if (!$user) {
            throw new \Exception('Invalid email or password.');
        }

        // Verify the password
        if (!password_verify($password, $user->getPassword())) {
            throw new \Exception('Invalid email or password.');
        }

        // Return the authenticated user
        return $user;
    }

    public function register(string $email, string $password): User
    {

        // Check if a user already exists with the same email
        if ($this->findOneByEmail($email)) {
            throw new \Exception('A user with this email already exists.');
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Create a new User entity
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($hashedPassword);

        // Save the user using the repository
        return $this->userRepository->save($user);
    }
    
    public function findOneByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        protected string $email,

        #[Assert\NotBlank]
        #[Assert\PasswordStrength]
        protected string $password
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

}
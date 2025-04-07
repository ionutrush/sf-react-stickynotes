<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateStickyNoteRequest
{
    public function __construct(
        #[Assert\CssColor]
        #[Assert\NotBlank]
        #[Assert\Length(max: 10)]
        public string $color,

        #[Assert\NotBlank]
        #[Assert\Length(max: 20)]
        public string $position,

        
        public ?string $body,

        public ?array $tags,
    )
    {
    }
}
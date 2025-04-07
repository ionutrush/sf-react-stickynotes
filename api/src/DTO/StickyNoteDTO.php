<?php

namespace App\DTO;

use App\Entity\StickyNote;

class StickyNoteDTO
{

    public int $id;

    public string $color;

    public string $position;

    public ?string $body;

    public ?array $tags;
    public string $createdAt;
    public string $author;
    
    public function __construct(
        StickyNote $stickyNote
    ) {
        $this->id = $stickyNote->getId();
        $this->color = $stickyNote->getColor();
        $this->position = $stickyNote->getPosition();
        $this->body = $stickyNote->getBody();
        $this->tags = array_map(
            fn($tag) => $tag->getName(),
            $stickyNote
                ->getTags()
                ->toArray()
        );
        $this->createdAt = $stickyNote->getCreatedAt()->format('Y-m-d H:i:s');
        $this->author = $stickyNote->getCreatedBy();
    }
}
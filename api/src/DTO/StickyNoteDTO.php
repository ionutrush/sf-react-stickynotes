<?php

namespace App\DTO;

use App\Entity\StickyNote;

class StickyNoteDTO
{

    public int $id;

    public string $color;

    public string $position;

    public ?string $body;

//    public string $createdAt;
//
//    public string $updatedAt;
//
//    public string $createdBy;
//
//    public string $updatedBy;
    
    public function __construct(
        StickyNote $stickyNote
    ) {
        $this->id = $stickyNote->getId();
        $this->color = $stickyNote->getColor();
        $this->position = $stickyNote->getPosition();
        $this->body = $stickyNote->getBody();
//        $this->createdAt = $stickyNote->getCreatedAt()->format('Y-m-d H:i:s');
//        $this->updatedAt = $stickyNote->getUpdatedAt()->format('Y-m-d H:i:s');
//        $this->createdBy = $stickyNote->getCreatedBy();
//        $this->updatedBy = $stickyNote->getUpdatedBy();
    }
}
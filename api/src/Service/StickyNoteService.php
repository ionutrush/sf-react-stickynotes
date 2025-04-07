<?php

namespace App\Service;

use App\Entity\StickyNote;
use App\Repository\StickyNoteRepository;

class StickyNoteService
{
    public function __construct(private StickyNoteRepository $repository) {}

    public function getAllNotes(): array
    {
        return $this->repository->findAll();
    }

    public function create(
        string $color,
        string $position,
        ?string $body = null,
    ): StickyNote
    {
        $stickyNote = new StickyNote();
        $stickyNote->setColor($color);
        $stickyNote->setPosition($position);
        if (!empty($body)) {
            $stickyNote->setBody($body);
        }

        return $this->repository->save($stickyNote);
    }

    public function update(StickyNote $stickyNote, string $color, string $position, ?string $body = null): StickyNote
    {
        $stickyNote->setColor($color);
        $stickyNote->setPosition($position);
        $stickyNote->setBody($body);

        return $this->repository->save($stickyNote);
    }

    public function delete(StickyNote $stickyNote): void
    {
        $this->repository->delete($stickyNote);
    }
}
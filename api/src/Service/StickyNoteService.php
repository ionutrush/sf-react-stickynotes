<?php

namespace App\Service;

use App\Entity\StickyNote;
use App\Repository\StickyNoteRepository;
use App\Repository\TagRepository;

readonly class StickyNoteService
{
    public function __construct(
        private StickyNoteRepository $repository,
        private TagRepository        $tagRepository
    ) {}

    public function getAllNotes(): array
    {
        return $this->repository->findAll();
    }

    public function create(
        string $color,
        string $position,
        ?string $body = null,
        ?array $tags = null
    ): StickyNote
    {
        $stickyNote = new StickyNote();
        $stickyNote->setColor($color);
        $stickyNote->setPosition($position);
        if (!empty($body)) {
            $stickyNote->setBody($body);
        }

        if (!empty($tags)) {
            foreach ($this->prepareTags($tags) as $tag) {
                $stickyNote->addTag($tag);
            }
        }

        return $this->repository->save($stickyNote);
    }

    public function update(StickyNote $stickyNote, string $color, string $position, ?string $body = null, ?array $tags): StickyNote
    {
        $stickyNote->setColor($color);
        $stickyNote->setPosition($position);
        $stickyNote->setBody($body);

        if (!empty($tags)) {
            foreach ($this->prepareTags($tags) as $tag) {
                $stickyNote->addTag($tag);
            }
        }

        return $this->repository->save($stickyNote);
    }

    public function delete(StickyNote $stickyNote): void
    {
        $this->repository->delete($stickyNote);
    }

    private function prepareTags(array $tags): array
    {
        $tagEntities = [];

        foreach ($tags as $tagName) {
            // Try finding an existing tag by name
            $tag = $this->tagRepository->findOneBy(['name' => $tagName]);

            if (!$tag) {
                // Tag doesn't exist, create new one
                $tag = $this->tagRepository->save($tagName);
            }

            $tagEntities[] = $tag;
        }

        return $tagEntities;

    }
}
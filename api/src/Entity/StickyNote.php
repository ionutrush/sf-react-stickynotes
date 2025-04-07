<?php

namespace App\Entity;

use App\Repository\StickyNoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StickyNoteRepository::class)]
class StickyNote
{
    use TimestampableEntity;
    use BlameableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
//    #[Groups(['note:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Assert\CssColor]
//    #[Groups(['note:read'])]
    private ?string $color = null;

    #[ORM\Column(length: 20)]
//    #[Groups(['note:read'])]
    private ?string $position = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
//    #[Groups(['note:read'])]
    private ?string $body = null;

    #[ORM\ManyToMany(targetEntity: Tag::class)]
//    #[Groups(['note:read'])]
    private Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function clearTags(): self
    {
        $this->tags->clear();
        return $this;
    }
}

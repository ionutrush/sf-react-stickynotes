<?php

namespace App\Security\Voter;

use App\Entity\StickyNote;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class StickyNoteVoter extends Voter
{

    public const EDIT = 'EDIT';
    public const DELETE = 'DELETE';


    public function __construct(private Security $security) {}

    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE]) && $subject instanceof StickyNote;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            self::EDIT, self::DELETE => $subject->getCreatedBy() === $user->getUserIdentifier(),
            default => false,
        };

    }
}
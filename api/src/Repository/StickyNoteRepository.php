<?php

namespace App\Repository;

use App\Entity\StickyNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StickyNote>
 */
class StickyNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StickyNote::class);
    }

    public function save(StickyNote $stickyNote, bool $flush = true): StickyNote
    {
        $this->getEntityManager()->persist($stickyNote);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $stickyNote;
    }
    
    public function delete(StickyNote $stickyNote, bool $flush = true): void
    {

        $this->getEntityManager()->remove($stickyNote);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}

<?php

namespace App\Hrm\CommonBundle\Service;

use App\Hrm\Common\Service\CommitTransaction;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCommitTransaction implements CommitTransaction
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit(): void
    {
        $this->entityManager->flush();
    }
}

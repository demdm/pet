<?php

namespace App\Hrm\CommonBundle\Service;

use App\Hrm\Common\Service\CommitTransactionService;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCommitTransactionService implements CommitTransactionService
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

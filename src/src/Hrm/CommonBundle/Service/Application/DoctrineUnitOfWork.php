<?php

namespace App\Hrm\CommonBundle\Service\Application;

use App\Hrm\Common\Application\Service\UnitOfWork;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUnitOfWork implements UnitOfWork
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

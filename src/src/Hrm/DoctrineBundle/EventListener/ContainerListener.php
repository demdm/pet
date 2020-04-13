<?php

namespace App\Hrm\DoctrineBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerListener
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}

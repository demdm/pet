<?php

namespace App\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render(
            '@Dashboard/home/index.html.twig'
        );
    }
}

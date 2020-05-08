<?php

namespace App\Hrm\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render(
            '@HrmDashboard/home/index.html.twig'
        );
    }
}

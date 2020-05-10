<?php

namespace App\Hrm\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    public function index()
    {
        $menu = $this->getParameter('menu');

        return $this->render(
            '@HrmDashboard/home/index.html.twig', [
                'menu' => $menu,
            ]
        );
    }
}

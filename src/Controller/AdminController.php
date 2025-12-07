<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin-login', name: 'admin_login')]
    public function adminLogin(): Response
    {
        return $this->render('admin/login.html.twig');
    }

    #[Route('/admin-panel', name: 'admin_main_panel')]
    public function adminPanel(): Response
    {
        return $this->render('admin/main-panel.html.twig');
    }
}

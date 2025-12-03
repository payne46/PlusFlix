<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminLoginController extends AbstractController
{
    #[Route('/admin-login', name: 'admin_login')]
    public function index(): Response
    {
        return $this->render('admin/login.html.twig');
    }
}

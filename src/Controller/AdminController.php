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

    #[Route('/admin/movie/add', name: 'admin_movie_add')]
    public function addMovie(): Response
    {
        return $this->render('admin/movie-form.html.twig', [
            'action' => 'add'
        ]);
    }

    #[Route('/admin/movie/edit/{id}', name: 'admin_movie_edit', requirements: ['id' => '\d+'])]
    public function editMovie(int $id): Response
    {
        return $this->render('admin/movie-form.html.twig', [
            'action' => 'edit',
            'id' => $id
        ]);
    }

    #[Route('/admin/platform/add', name: 'admin_platform_add')]
    public function addPlatform(): Response
    {
        return $this->render('admin/platform-form.html.twig', [
            'action' => 'add'
        ]);
    }

    #[Route('/admin/platform/edit/{id}', name: 'admin_platform_edit', requirements: ['id' => '\d+'])]
    public function editPlatform(int $id): Response
    {
        return $this->render('admin/platform-form.html.twig', [
            'action' => 'edit',
            'id' => $id
        ]);
    }
}

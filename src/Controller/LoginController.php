<?php

namespace App\Controller;

use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    #[Route('/admin-login', name: 'admin_login')]
    public function adminLogin(Request $request, AdminRepository $adminRepository): Response
    {
        if ($request->isMethod('POST')) {
            $login = $request->request->get('login');
            $password = $request->request->get('password');

            $admin = $adminRepository->findOneBy(['login' => $login]);

            if (!$admin || $admin->getPassword() !== $password) {
                return $this->render('admin/login.html.twig', [
                    'error' => 'Nieprawidłowy login lub hasło!'
                ]);
            }

            $request->getSession()->set('admin_logged', true);

            return $this->redirectToRoute('admin_main_panel');
        }

        return $this->render('admin/login.html.twig');
    }
}

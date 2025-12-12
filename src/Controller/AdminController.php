<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\StreamingPlatformRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;
use App\Entity\StreamingPlatform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    private function saveMovie(
        Request $request,
        EntityManagerInterface $em,
        ?Movie $movie = null,
    ): Movie {

        if (!$movie) {
            $movie = new Movie();
        }

        $movie->setTitle($request->request->get('title'));
        $movie->setDescription($request->request->get('description'));
        $movie->setDirector($request->request->get('director'));
        $movie->setScreenwriter($request->request->get('screenwriter'));
        $movie->setGenre($request->request->get('genre'));
        $movie->setCountry($request->request->get('country'));
        $movie->setBanner($request->request->get('banner'));

        $releaseDate = $request->request->get('releaseDate');
        $movie->setReleaseDate($releaseDate ? new \DateTime($releaseDate) : null);

        $length = $request->request->get('length');
        $movie->setLength($length !== null ? (int)$length : null);

        $rating = $request->request->get('rating');
        $movie->setRating($rating !== null ? (string)$rating : null);
        $movie->setRatingsCount($rating !== null && $rating!==0 ? 1 : 0);

        $em->persist($movie);
        $em->flush();

        return $movie;
    }

    #[Route('/admin-panel', name: 'admin_main_panel')]
    public function adminPanel(
        Request $request,
        MovieRepository $movieRepository,
        StreamingPlatformRepository $streamingPlatformRepository
    ): Response
    {
        if (!$request->getSession()->get('admin_logged')) {
            return $this->redirectToRoute('admin_login');
        }

        $movies = $movieRepository->findAll();
        $streamingPlatforms = $streamingPlatformRepository->findAll();

        return $this->render('admin/main-panel.html.twig', [
            'movies'             => $movies,
            'streamingPlatforms' => $streamingPlatforms,
        ]);
    }

    #[Route('/admin/movie/add', name: 'admin_movie_add')]
    public function addMovie(
        Request $request,
        EntityManagerInterface $em,
    ): Response
    {
        $movie = new Movie();

        if ($request->isMethod('POST')) {
            $this->saveMovie($request, $em);
            return $this->redirectToRoute('admin_main_panel');
        }

        return $this->render('admin/movie-form.html.twig', [
            'action' => 'add'
        ]);
    }

    #[Route('/admin/movie/edit/{id}', name: 'admin_movie_edit', requirements: ['id' => '\d+'])]
    public function editMovie(
        int $id,
        MovieRepository $movieRepository,
        Request $request,
        EntityManagerInterface $em,
        ): Response
    {
        // get movie by id
        $movie = $movieRepository->find($id);

        if (!$movie) {
            throw $this->createNotFoundException('Film o podanym ID nie istnieje.');
        }

        if ($request->isMethod('POST')) {
            $this->saveMovie($request, $em, $movie);
            return $this->redirectToRoute('admin_main_panel');
        }

        return $this->render('admin/movie-form.html.twig', [
            'action' => 'edit',
            'id' => $id,
            'movie' => $movie,
        ]);
    }

    private function savePlatform(
        Request $request,
        EntityManagerInterface $em,
        ?StreamingPlatform $platform = null,
    ): StreamingPlatform {
        if (!$platform) {
            $platform = new StreamingPlatform();
        }
        $platform->setName($request->request->get('name'));
        $platform->setWebsiteUrl($request->request->get('websiteUrl'));
        $platform->setBanner($request->request->get('banner'));

        $em->persist($platform);
        $em->flush();

        return $platform;
    }

    #[Route('/admin/platform/add', name: 'admin_platform_add')]
    public function addPlatform(
        Request $request,
        EntityManagerInterface $em,
    ): Response
    {
        if ($request->isMethod('POST')) {
            $this->savePlatform($request, $em);
            return $this->redirectToRoute('admin_main_panel');
        }
        return $this->render('admin/platform-form.html.twig', [
            'action' => 'add'
        ]);
    }

    #[Route('/admin/platform/edit/{id}', name: 'admin_platform_edit', requirements: ['id' => '\d+'])]
    public function editPlatform(
        int $id,
        StreamingPlatformRepository $streamingPlatformRepository,
        Request $request,
        EntityManagerInterface $em,
    ): Response
    {
        $platform = $streamingPlatformRepository->find($id);

        if (!$platform) {
            throw $this->createNotFoundException('Platforma o podanym ID nie istnieje.');
        }

        if ($request->isMethod('POST')) {
            $this->savePlatform($request, $em, $platform);
            return $this->redirectToRoute('admin_main_panel');
        }
        return $this->render('admin/platform-form.html.twig', [
            'action' => 'edit',
            'id' => $id,
            'platform' => $platform,
        ]);
    }
}

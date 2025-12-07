<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\StreamingPlatformRepository;
use App\Entity\Movie;
use App\Entity\StreamingPlatform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        MovieRepository $movieRepository,
        StreamingPlatformRepository $streamingPlatformRepository): Response
    {
        // Get query string
        $query = $request->query->get('q');

        // Get all movies
        $movies = $movieRepository->findAll();

        // Get top movies
        $topMovies = $movieRepository->getTopMovies(3);

        // Get streaming platforms
        $streamingPlatforms = $streamingPlatformRepository->findAll();

        if ($query) {

            $serachResults = $movieRepository->search($query);

            return $this->render('movie/index.html.twig', [
                'movies'             => $movies,
                'topMovies'          => $topMovies,
                'streamingPlatforms' => $streamingPlatforms,
                'searchResults'      => $serachResults
            ]);
        }

        return $this->render('movie/index_mockup.html.twig', [
            'movies'        => $movies,
            'topMovies'     => $topMovies,
            'streamingPlatforms'     => $streamingPlatforms,
        ]);
    }

    #[Route('/movie/{id}', name: 'movie_show', requirements: ['id' => '\d+'])]
    public function show(int $id, MovieRepository $movieRepository): Response
    {
        $movie = $movieRepository->find($id);

        if (!$movie) {
            throw $this->createNotFoundException('Film o podanym ID nie istnieje.');
        }

        return $this->render('movie/show_mockup.html.twig', [
            'movie' => $movie,
        ]);
    }
}

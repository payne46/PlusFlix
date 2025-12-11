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
        $phrase = $request->query->get('phrase');
        $categoriesString = $request->query->get('categories');

        $phrase = ($phrase !== null && $phrase !== '') 
            ? $phrase 
            : null;

        $categoriesString = ($categoriesString !== null && $categoriesString !== '') 
            ? $categoriesString 
            : null;

        $categoriesArray = [];
        if ($categoriesString !== null) {
            $categoriesArray = array_filter(
                array_map('trim', explode(';', $categoriesString)),
                static fn ($v) => $v !== ''
            );
        }
        
        $movies = [];
       
        $favouritesClicked = false;
        if (in_array('favourites', $categoriesArray)) {         
            $favouritesCookie = $request->cookies->get('favourites', ''); 
            $favouriteIds = array_filter(array_map('intval', explode(',', $favouritesCookie)));
            

            if (!empty($favouriteIds)) {
                $favouritesClicked = true;
                $favouriteMovies = $movieRepository->findBy(['id' => $favouriteIds]);
                $movies = array_merge($movies, $favouriteMovies);
            }
            
            $categoriesArray = array_filter($categoriesArray, fn($c) => $c !== 'favourites');
        }

        if ($phrase !== null || !empty($categoriesArray)) {
            $searchResults = $movieRepository->search($phrase, $categoriesArray);
            $movies = array_merge($movies, $searchResults);

            return $this->render('movie/index.html.twig', [
                'searchResults'      => $searchResults,
                'currentPhrase'      => $phrase,
                'currentCategories'  => $categoriesArray,
                'categoriesString'   => $categoriesString,
                'favouritesClicked'  => $favouritesClicked,
            ]);
        }

        if (empty($movies)) {
            $movies = $movieRepository->findAll();
        }

        $movies = array_unique($movies, SORT_REGULAR);

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
            'favouritesClicked'  => $favouritesClicked,
        ]);
    }

    #[Route('/movie/{id}', name: 'movie_show', requirements: ['id' => '\d+'])]
    public function show(int $id, MovieRepository $movieRepository): Response
    {
        $movie = $movieRepository->find($id);

        if (!$movie) {
            throw $this->createNotFoundException('Film o podanym ID nie istnieje.');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}

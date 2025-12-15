<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Movie;
use App\Entity\StreamingPlatform;
use App\Entity\MovieStreamingPlatform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly string $projectDir
    ) { }

    public function load(ObjectManager $manager): void
    {
        $this->loadAdmins($manager);
        $platforms = $this->loadStreamingPlatforms($manager);
        $manager->flush();

        $movies = $this->loadMovies($manager);
        $manager->flush();

        $this->assignPlatformsToMovies($manager, $movies, $platforms);
        $manager->flush();
    }

    private function loadAdmins(ObjectManager $manager): void
    {
        $path = $this->projectDir . '/config/fixtures/admins.json';
        $data = $this->readJson($path);

        foreach ($data as $row) {
            $admin = new Admin();
            $admin->setLogin($row['login']);
            $admin->setPassword($row['password']);
            $manager->persist($admin);
        }
    }

    private function loadStreamingPlatforms(ObjectManager $manager): array
    {
        $path = $this->projectDir . '/config/fixtures/streaming_platforms.json';
        $data = $this->readJson($path);

        $platforms = [];

        foreach ($data as $row) {
            $platform = new StreamingPlatform();
            $platform->setName($row['name']);
            $platform->setBanner($row['banner']);
            $platform->setWebsiteUrl($row['websiteUrl']);
            $manager->persist($platform);

            $platforms[] = $platform;
        }

        return $platforms;
    }

    private function loadMovies(ObjectManager $manager): array
    {
        $path = $this->projectDir . '/config/fixtures/movies.json';
        $data = $this->readJson($path);

        $defaultColors = ['#0D9CFF', '#FF5733', '#33FF57', '#FF33F6', '#33FFF6', '#F6FF33', '#8A33FF', '#FF8A33', '#33FF8A', '#FF3333',];

        $movies = [];
        $setRatingData = function (Movie $movie): void {
            $movie->setRating(random_int(1, 5));
            $movie->setRatingsCount(random_int(5, 100));
        };

        foreach ($data as $row) {
            $movie = new Movie();
            $movie->setTitle($row['title']);
            $movie->setDescription($row['description']);
            $movie->setReleaseDate(new \DateTime($row['releaseDate']));
            $movie->setDirector($row['director']);
            $movie->setScreenwriter($row['screenwriter']);
            $movie->setGenre($row['genre']);
            $movie->setLength($row['length']);
            $movie->setCountry($row['country']);
            $setRatingData($movie);

            if (isset($row['banner']) && !empty($row['banner']))
            {
                $movie->setBanner($row['banner']);
            }
            else
            {
                $randomColorIndex = array_rand($defaultColors);
                $movie->setBanner($defaultColors[$randomColorIndex]);
            }

            $manager->persist($movie);

            $movies[] = $movie;
        }

        return $movies;
    }

    private function assignPlatformsToMovies(ObjectManager $manager, array $movies, array $platforms): void {
        if (empty($platforms) || empty($movies))
        {
            return;
        }

        foreach ($movies as $movie)
        {
            $numPlatforms = min(random_int(1, 3), count($platforms));
            $randomKeys = array_rand($platforms, $numPlatforms);

            if (!is_array($randomKeys))
            {
                $randomKeys = [$randomKeys];
            }

            foreach ($randomKeys as $key)
            {
                $platform = $platforms[$key];

                $moviePlatform = new MovieStreamingPlatform();
                $moviePlatform->setMovie($movie);
                $moviePlatform->setStreamingPlatform($platform);

                $manager->persist($moviePlatform);
            }
        }
    }
    private function readJson(string $path): array
    {
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf('Fixture file not found: %s', $path));
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new \RuntimeException(sprintf('Cannot read fixture file: %s', $path));
        }

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return $data;
    }
}

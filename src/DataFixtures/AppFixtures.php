<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Movie;
use App\Entity\StreamingPlatform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly string $projectDir
    ) { }

    public function load(ObjectManager $manager): void
    {
        // Configuration
        $this->loadAdmins($manager);

        // Content
        $platforms = $this->loadStreamingPlatforms($manager);
        $this->loadMovies($manager, $platforms);

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
            
            $platforms[$row['name']] = $platform;
        }

        return $platforms;
    }

    private function loadMovies(ObjectManager $manager): void
    {
        $path = $this->projectDir . '/config/fixtures/movies.json';
        $data = $this->readJson($path);

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
            $manager->persist($movie);
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

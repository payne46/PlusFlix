<?php

namespace App\Entity;

use App\Repository\MovieStreamingPlatformRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieStreamingPlatformRepository::class)]
class MovieStreamingPlatform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $movie = null;

    #[ORM\Column]
    private ?int $streamingPlatform = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?int
    {
        return $this->movie;
    }

    public function setMovie(int $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    public function getStreamingPlatform(): ?int
    {
        return $this->streamingPlatform;
    }

    public function setStreamingPlatform(int $streamingPlatform): static
    {
        $this->streamingPlatform = $streamingPlatform;

        return $this;
    }
}

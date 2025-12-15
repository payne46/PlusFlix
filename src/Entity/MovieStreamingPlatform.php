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

    #[ORM\ManyToOne(targetEntity: Movie::class)]
    #[ORM\JoinColumn(name: 'movie', referencedColumnName: 'id', nullable: false)]
    private ?Movie $movie = null;

    #[ORM\ManyToOne(targetEntity: StreamingPlatform::class)]
    #[ORM\JoinColumn(name: 'streaming_platform', referencedColumnName: 'id', nullable: false)]
    private ?StreamingPlatform $streamingPlatform = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    public function getStreamingPlatform(): ?StreamingPlatform
    {
        return $this->streamingPlatform;
    }

    public function setStreamingPlatform(?StreamingPlatform $streamingPlatform): static
    {
        $this->streamingPlatform = $streamingPlatform;

        return $this;
    }
}

<?php

namespace App\Repository;

use App\Entity\MovieStreamingPlatform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieStreamingPlatform>
 */
class MovieStreamingPlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieStreamingPlatform::class);
    }

    public function findPlatformsByMovieId(int $movieId): array
    {
        return $this->createQueryBuilder('msp')
            ->select('msp', 'sp')
            ->leftJoin('msp.streamingPlatform', 'sp')
            ->where('msp.movie = :movieId')
            ->setParameter('movieId', $movieId)
            ->getQuery()
            ->getResult();
    }

    public function findMoviesByPlatformId(int $platformId): array
    {
        return $this->createQueryBuilder('msp')
            ->select('msp', 'm')
            ->leftJoin('msp.movie', 'm')
            ->where('msp.streamingPlatform = :platformId')
            ->setParameter('platformId', $platformId)
            ->getQuery()
            ->getResult();
    }

    public function findAllWithDetails(): array
    {
        return $this->createQueryBuilder('msp')
            ->select('msp', 'm', 'sp')
            ->leftJoin('msp.movie', 'm')
            ->leftJoin('msp.streamingPlatform', 'sp')
            ->getQuery()
            ->getResult();
    }
}

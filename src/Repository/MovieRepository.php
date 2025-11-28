<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }
    
    public function getTopMovies(int $limit = 5): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.rating', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function search(string $value): array
    {        
        // Not implemented
        return [];
    }
}

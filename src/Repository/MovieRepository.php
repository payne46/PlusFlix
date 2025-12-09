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

    public function search(?string $text, array $categories = []): array
    {
       $qb = $this->createQueryBuilder('m');

        if ($text) {
            $search = '%' . mb_strtolower($text) . '%';

            $qb->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('LOWER(m.title)',         ':search'),
                    $qb->expr()->like('LOWER(m.description)',   ':search'),
                    $qb->expr()->like('LOWER(m.director)',      ':search'),
                    $qb->expr()->like('LOWER(m.screenwriter)',  ':search')
                )
            )
            ->setParameter('search', $search);
        }

        if (!empty($categories)) {
            $categoriesLower = array_map('mb_strtolower', $categories);

            $qb->andWhere(
                $qb->expr()->in('LOWER(m.genre)', ':categories')
            )
            ->setParameter('categories', $categoriesLower);
        }

        return $qb->getQuery()->getResult();
    }
}

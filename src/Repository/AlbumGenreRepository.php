<?php

namespace App\Repository;

use App\Entity\AlbumGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlbumGenre>
 *
 * @method AlbumGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumGenre[]    findAll()
 * @method AlbumGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumGenre::class);
    }

//    /**
//     * @return AlbumGenre[] Returns an array of AlbumGenre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AlbumGenre
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

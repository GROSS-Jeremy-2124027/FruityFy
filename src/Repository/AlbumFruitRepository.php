<?php

namespace App\Repository;

use App\Entity\AlbumFruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlbumFruit>
 *
 * @method AlbumFruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumFruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumFruit[]    findAll()
 * @method AlbumFruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumFruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumFruit::class);
    }

//    /**
//     * @return AlbumFruit[] Returns an array of AlbumFruit objects
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

//    public function findOneBySomeField($value): ?AlbumFruit
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

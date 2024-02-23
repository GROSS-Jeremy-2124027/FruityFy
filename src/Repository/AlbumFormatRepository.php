<?php

namespace App\Repository;

use App\Entity\AlbumFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlbumFormat>
 *
 * @method AlbumFormat|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumFormat|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumFormat[]    findAll()
 * @method AlbumFormat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumFormatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumFormat::class);
    }

//    /**
//     * @return AlbumFormat[] Returns an array of AlbumFormat objects
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

//    public function findOneBySomeField($value): ?AlbumFormat
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

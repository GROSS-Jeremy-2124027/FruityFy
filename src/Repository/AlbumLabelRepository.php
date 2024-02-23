<?php

namespace App\Repository;

use App\Entity\AlbumLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlbumLabel>
 *
 * @method AlbumLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumLabel[]    findAll()
 * @method AlbumLabel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumLabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumLabel::class);
    }

//    /**
//     * @return AlbumLabel[] Returns an array of AlbumLabel objects
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

//    public function findOneBySomeField($value): ?AlbumLabel
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

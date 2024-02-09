<?php

namespace App\Repository;

use App\Entity\ReferenceFruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReferenceFruit>
 *
 * @method ReferenceFruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReferenceFruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReferenceFruit[]    findAll()
 * @method ReferenceFruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferenceFruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReferenceFruit::class);
    }

//    /**
//     * @return ReferenceFruit[] Returns an array of ReferenceFruit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReferenceFruit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

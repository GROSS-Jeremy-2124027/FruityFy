<?php

namespace App\Repository;

use App\Entity\RechercheFruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RechercheFruit>
 *
 * @method RechercheFruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheFruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheFruit[]    findAll()
 * @method RechercheFruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheFruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheFruit::class);
    }

//    /**
//     * @return RechercheFruit[] Returns an array of RechercheFruit objects
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

//    public function findOneBySomeField($value): ?RechercheFruit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

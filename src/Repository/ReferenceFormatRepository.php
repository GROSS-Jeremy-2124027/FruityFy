<?php

namespace App\Repository;

use App\Entity\ReferenceFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReferenceFormat>
 *
 * @method ReferenceFormat|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReferenceFormat|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReferenceFormat[]    findAll()
 * @method ReferenceFormat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferenceFormatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReferenceFormat::class);
    }

//    /**
//     * @return ReferenceFormat[] Returns an array of ReferenceFormat objects
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

//    public function findOneBySomeField($value): ?ReferenceFormat
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

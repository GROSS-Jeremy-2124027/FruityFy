<?php

namespace App\Repository;

use App\Entity\ReferenceGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReferenceGenre>
 *
 * @method ReferenceGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReferenceGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReferenceGenre[]    findAll()
 * @method ReferenceGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferenceGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReferenceGenre::class);
    }

//    /**
//     * @return ReferenceGenre[] Returns an array of ReferenceGenre objects
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

//    public function findOneBySomeField($value): ?ReferenceGenre
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\UserArtiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserArtiste>
 *
 * @method UserArtiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserArtiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserArtiste[]    findAll()
 * @method UserArtiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserArtiste::class);
    }

//    /**
//     * @return UserArtiste[] Returns an array of UserArtiste objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserArtiste
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

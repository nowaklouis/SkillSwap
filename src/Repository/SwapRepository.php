<?php

namespace App\Repository;

use App\Entity\Swap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Swap>
 *
 * @method Swap|null find($id, $lockMode = null, $lockVersion = null)
 * @method Swap|null findOneBy(array $criteria, array $orderBy = null)
 * @method Swap[]    findAll()
 * @method Swap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Swap::class);
    }

//    /**
//     * @return Swap[] Returns an array of Swap objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Swap
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Registered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Registered>
 *
 * @method Registered|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registered|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registered[]    findAll()
 * @method Registered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegisteredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registered::class);
    }

    //    /**
    //     * @return Registered[] Returns an array of Registered objects
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

    //    public function findOneBySomeField($value): ?Registered
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findOneByUserAndSwap($user, $swapId): ?Registered
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.users = :userId')
            ->setParameter('userId', $user->getId())
            ->andWhere('r.swaps = :swapId')
            ->setParameter('swapId', $swapId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

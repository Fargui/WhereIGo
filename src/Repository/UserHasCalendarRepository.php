<?php

namespace App\Repository;

use App\Entity\UserHasCalendar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserHasCalendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasCalendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasCalendar[]    findAll()
 * @method UserHasCalendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasCalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHasCalendar::class);
    }

    // /**
    //  * @return UserHasCalendar[] Returns an array of UserHasCalendar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserHasCalendar
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\CalendarHasPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CalendarHasPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendarHasPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendarHasPlace[]    findAll()
 * @method CalendarHasPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarHasPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendarHasPlace::class);
    }

    // /**
    //  * @return CalendarHasPlace[] Returns an array of CalendarHasPlace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CalendarHasPlace
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

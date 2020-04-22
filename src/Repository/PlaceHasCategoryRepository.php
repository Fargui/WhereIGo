<?php

namespace App\Repository;

use App\Entity\PlaceHasCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaceHasCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceHasCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceHasCategory[]    findAll()
 * @method PlaceHasCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceHasCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceHasCategory::class);
    }

    // /**
    //  * @return PlaceHasCategory[] Returns an array of PlaceHasCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaceHasCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

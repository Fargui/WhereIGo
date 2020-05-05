<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Place;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRepository extends ServiceEntityRepository
{
    /* Afficher des places aleatoires */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }

    public function getPictureRandom(){
        $stmt = $this->createQueryBuilder( 'e' );
        $stmt->select('e');
        $stmt->orderBy( 'RAND()' );
        $stmt->setMaxResults( 5 );

        return $stmt->getQuery()->getResult();
    }

    /**
     * Récupère les places en lien avec une recherche
     *
     * @return Place[]
     */
     public function findSearch(SearchData $data):array
     {      
        $query = $this->createQueryBuilder('p')
             ->select('c', 'p')
             ->leftJoin('p.placeHasCategories', 'c');

        if (!empty($data->placeHasCategories)){           
        $query = $query
                 ->andWhere('c.category IN(:placeHasCategories)')
                 ->setParameter('placeHasCategories', $data->placeHasCategories);
            }

         return $query->getQuery()->getResult();
     }


     /**
     * Récupère les places en lien avec une recherche
     *
     * 
     */
    public function tunnel(SearchData $data):array
    {      
       $query = $this->createQueryBuilder('p')
            ->select('c', 'p')
            ->leftJoin('p.placeHasCategories', 'c');

       if (!empty($data->subcategories)){           
       $query = $query
                ->andWhere('c.category IN(:placeHasCategories)')
                ->setParameter('placeHasCategories', $data->subcategories);
           }

        return $query->getQuery()->getResult();
    }

    /**
     * Récupère les places en lien avec une recherche
     *
     * @return Place[]
     */
    public function allPlace():array
    {      
       $query = $this->createQueryBuilder('p')
            ->select('c', 'p')
            ->leftJoin('p.placeHasCategories', 'c');

        return $query->getQuery()->getResult();
    }
}

/*     public function allCustomQuery()
    {
        $stmt = $this->createQueryBuilder('p');
        $stmt->select('p.name, p.description');
        return $stmt->getQuery()->getResult();
    } */

    // /**
    //  * @return Place[] Returns an array of Place objects
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
    public function findOneBySomeField($value): ?Place
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


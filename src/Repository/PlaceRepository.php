<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Place;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRepository extends ServiceEntityRepository
{

    private $paginator;


    /* Afficher des places aleatoires */
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Place::class);
        $this->paginator = $paginator;
    }

    

    /**
     * Récupère les places en lien avec une recherche
     *
     * @return Place[]
     */
     public function findSearch(SearchData $data): PaginationInterface
 
     {      


       
        $query = $this->createQueryBuilder('p')
             ->select('c', 'p')
             ->leftJoin('p.placeHasCategories', 'c');


             if (!empty($data->q)){ 
        
                $query = $query
                          ->andWhere( 'p.name LIKE :query' )
                          ->setParameter( 'query', '%' . ($data->q) . '%');
                
             }    
             

        if (!empty($data->placeHasCategories)){           
        $query = $query
                 ->andWhere('c.category IN(:placeHasCategories)')
                 ->setParameter('placeHasCategories', $data->placeHasCategories);
            }

        if (!empty($data->min)){           
            $query = $query
                     ->andWhere('p.price >= :min')
                     ->setParameter('min', $data->min);
                }

        if (!empty($data->max)){           
            $query = $query
                     ->andWhere('p.price <= :max')
                     ->setParameter('max', $data->max);
                }


            
                $query = $query->getQuery();
                return $this->paginator->paginate(
                    $query,
                    $data->page,
                    8,
                   
                );
     }


     
   

   



    public function getPictureRandom(){
        $query = $this->createQueryBuilder( 'e' );
        $query->select('e');
        $query->orderBy( 'RAND()' );
        $query->setMaxResults( 5 );

        return $query->getQuery()->getResult();
    }

 
}

/*     public function allCustomQuery()
    {
        $query = $this->createQueryBuilder('p');
        $query->select('p.name, p.description');
        return $query->getQuery()->getResult();
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


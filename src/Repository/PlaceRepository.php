<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Data\TunnelData;
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
   

        if (!empty($data->placeHasCategories)){           
        $query = $query
                 ->andWhere('c.category IN(:placeHasCategories)')
                 ->setParameter('placeHasCategories', $data->placeHasCategories);
            }


        if (!empty($data->q)){ 
    
            $query = $query
                      ->andWhere( 'p.name LIKE :query' )
                      ->setParameter( 'query', '%' . ($data->q) . '%');
            
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


     /**
     * Renvoie une place random // reponses user
     */
     public function findTunnel($reponse_1, $reponse_2, $reponse_3, $reponse_4) {
        $query = $this->createQueryBuilder( 'p' )
        ->select('p', 'r')
        ->join('p.idReponse', 'r')
        
              
                     ->where('r.id = (:placeHasCategories) ')
                     ->setParameter('placeHasCategories', $reponse_1 . ' && '.$reponse_2 . ' && '.$reponse_3 . ' && '.$reponse_4 )
                     ->orderBy( 'RAND()' )
                     ->setMaxResults( 1 );
                
               
            
                     /* ->andWhere('r.id = (:placeHasCategories2)')
                     ->setParameter('placeHasCategories2', $reponse_2)
                     

               
            
                     ->andWhere('r.id = (:placeHasCategories3)')
                     ->setParameter('placeHasCategories3', $reponse_3)
                     

                  
            
                     ->andWhere('r.id = (:placeHasCategories4)')
                     ->setParameter('placeHasCategories4', $reponse_4) */
                    
        ;
        dump($query);
        return $query->getQuery()->getResult();
       
    }
     
   



    public function getPictureRandom(){
        $query = $this->createQueryBuilder( 'e' );
        $query->select('e');
        $query->orderBy( 'RAND()' );
        $query->setMaxResults( 5 );

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


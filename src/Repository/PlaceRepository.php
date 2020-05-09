<?php

namespace App\Repository;

use App\Entity\Place;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
     public function findTunnel() {
    

        $conn = $this->getEntityManager()->getConnection();

    $sql = 
    'SELECT * FROM place p
    WHERE p.id IN
    ( select place_id FROM reponse_place rp WHERE rp.reponse_id = 4
      INTERSECT
      select place_id FROM reponse_place rp WHERE rp.reponse_id = 7
      INTERSECT
      select place_id FROM reponse_place rp WHERE rp.reponse_id = 9
      INTERSECT
      select place_id FROM reponse_place rp WHERE rp.reponse_id = 12
    )';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

   
    return $query = $stmt->fetchAll();
    
        dump($query);
       
    }
     
   
  

    public function getPictureRandom(){
        $query = $this->createQueryBuilder( 'e' );
        $query->select('e');
        $query->orderBy( 'RAND()' );
        $query->setMaxResults( 5 );

        return $query->getQuery()->getResult();
    }

    /**
     * Récupère les places pour la map
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


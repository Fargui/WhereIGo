<?php

namespace App\Repository;

use App\Entity\Place;
use App\Data\SearchData;
use App\Data\TunnelData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
     public function findTunnel(Request $request) {

        $conn = $this->getEntityManager()->getConnection();

                 
        $reponse_1 = $request->query->get('reponse_1');
        $reponse_3 = $request->query->get('reponse_3');
        $reponse_4 = $request->query->get('reponse_4');
        $reponse_5 = $request->query->get('reponse_5');

        $sql = '
        select p.name, pic.name as picname, p.description, p.country, p.id from place p
        INNER JOIN picture pic ON p.id = pic.place_id
        where p.id in
        ( select place_id from reponse_place rp where rp.reponse_id = :reponse_1
          intersect
          select place_id from reponse_place rp where rp.reponse_id = :reponse_3
            intersect
          select place_id from reponse_place rp where rp.reponse_id = :reponse_4
            intersect
          select place_id from reponse_place rp where rp.reponse_id = :reponse_5
        )
        ORDER BY RAND()
        LIMIT 1
        ;
            ';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('reponse_1', $reponse_1);
        $stmt->bindValue('reponse_3', $reponse_3);
        $stmt->bindValue('reponse_4', $reponse_4);
        $stmt->bindValue('reponse_5', $reponse_5);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
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


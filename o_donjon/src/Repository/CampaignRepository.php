<?php

namespace App\Repository;

use App\Entity\Campaign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campaign|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campaign|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campaign[]    findAll()
 * @method Campaign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampaignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campaign::class);
    }
    
    // requête personnalisée pour récupérer les campagnes où l'utilisateur est joueur
    public function findByUser($userId)
    {   
        $qb = $this->createQueryBuilder('campaign') // on créer la requête pour la table campaign
           ->leftJoin ('campaign.users','users') // on joint la table user à traver la table intermédiaire campaign_user
           ->where('users.id = :id') // on récupère les campagnes associées à l'ID
           ->setParameter('id', $userId); // on associe l'ID de l'utilisateur au paramètre ID
         
        $query = $qb->getQuery(); // on prépare la requête
        $results = $query->getResult(); // on lance la requête
        return $results; // on return les résultats
    }

    public function findByUserAndByCampaign($userId, $campaignId)
    {
        $qb = $this->createQueryBuilder('c')
           ->leftJoin ('c.users','u')
           ->where('u.id = :id')
           ->setParameter('id', $userId)
           ->andWhere('c.id = :campaignId')
           ->setParameter('campaignId', $campaignId);
         
        // dd($qb);
        $query = $qb->getQuery();
        // dd($query);
        $results = $query->getResult();
        return $results;
    }
    
    // public function findWithStats($id)
    // {
    //     return $this->createQueryBuilder('c')
    //         ->leftJoin()
    //         ->andWhere('c.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('c.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // /**
    //  * @return Campaign[] Returns an array of Campaign objects
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
    public function findOneBySomeField($value): ?Campaign
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

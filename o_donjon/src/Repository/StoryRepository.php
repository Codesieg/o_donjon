<?php

namespace App\Repository;

use App\Entity\Story;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Story|null find($id, $lockMode = null, $lockVersion = null)
 * @method Story|null findOneBy(array $criteria, array $orderBy = null)
 * @method Story[]    findAll()
 * @method Story[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Story::class);
    }

    // requête personnalisée pour récupérer les campagnes archivées d'un DM
    // public function findByCampaign($campaignId)
    // {   
    //     $qb = $this->createQueryBuilder('campaign') // on créer la requête pour la table campaign
    //     ->leftJoin ('campaign.stories','stories') 
    //     ->andWhere('campaign.id = :id') // on récupère les campagnes associées à l'ID
    //     ->setParameter('id', $campaignId); // on associe l'ID de l'utilisateur au paramètre ID
    //     $query = $qb->getQuery(); // on prépare la requête
    //     $results = $query->getResult(); // on lance la requête
    //     return $results; // on return les résultats
    // }
    // /**
    //  * @return Story[] Returns an array of Story objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Story
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

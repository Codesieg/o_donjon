<?php

namespace App\Repository;

use App\Entity\CampaignUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CampaignUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampaignUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampaignUser[]    findAll()
 * @method CampaignUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampaignUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampaignUser::class);
    }

    // /**
    //  * @return CampaignUser[] Returns an array of CampaignUser objects
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
    public function findOneBySomeField($value): ?CampaignUser
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

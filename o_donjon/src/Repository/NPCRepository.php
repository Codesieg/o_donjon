<?php

namespace App\Repository;

use App\Entity\NPC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NPC|null find($id, $lockMode = null, $lockVersion = null)
 * @method NPC|null findOneBy(array $criteria, array $orderBy = null)
 * @method NPC[]    findAll()
 * @method NPC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NPCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NPC::class);
    }

    // /**
    //  * @return NPC[] Returns an array of NPC objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NPC
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

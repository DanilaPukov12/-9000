<?php

namespace App\Repository;

use App\Entity\ContactFeedbackStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactFeedbackStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactFeedbackStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactFeedbackStatus[]    findAll()
 * @method ContactFeedbackStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactFeedbackStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactFeedbackStatus::class);
    }

    // /**
    //  * @return ContactFeedbackStatus[] Returns an array of ContactFeedbackStatus objects
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
    public function findOneBySomeField($value): ?ContactFeedbackStatus
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

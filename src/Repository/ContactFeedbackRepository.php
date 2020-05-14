<?php

namespace App\Repository;

use App\Entity\ContactFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContactFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactFeedback[]    findAll()
 * @method ContactFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactFeedback::class);
    }

    public function deleteAll()
    {
        return $this->createQueryBuilder('c')
            ->delete()
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ContactFeedback[] Returns an array of ContactFeedback objects
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
    public function findOneBySomeField($value): ?ContactFeedback
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

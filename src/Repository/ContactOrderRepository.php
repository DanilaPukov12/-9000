<?php

namespace App\Repository;

use App\Entity\ContactOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContactOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactOrder[]    findAll()
 * @method ContactOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactOrder::class);
    }

    // /**
    //  * @return ContactOrder[] Returns an array of ContactOrder objects
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
    public function findOneBySomeField($value): ?ContactOrder
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

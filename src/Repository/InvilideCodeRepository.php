<?php

namespace App\Repository;

use App\Entity\InvilideCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InvilideCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvilideCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvilideCode[]    findAll()
 * @method InvilideCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvilideCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvilideCode::class);
    }

    // /**
    //  * @return InvilideCode[] Returns an array of InvilideCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InvilideCode
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

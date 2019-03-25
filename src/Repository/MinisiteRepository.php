<?php

namespace App\Repository;

use App\Entity\Minisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Minisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minisite[]    findAll()
 * @method Minisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinisiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Minisite::class);
    }

    // /**
    //  * @return Minisite[] Returns an array of Minisite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Minisite
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

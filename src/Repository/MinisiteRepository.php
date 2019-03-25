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

    /**
     * Liste des minisites
     */
    public function lists()
    {
        return $this->createQueryBuilder('m')
            ->select("m.name","m.ndd","m.id")
            ->getQuery()->getArrayResult()
        ;
    }

}

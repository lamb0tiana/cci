<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function getMenu()
    {
        $qb = $this->createQueryBuilder("c");
        return $qb->select("c.name,c.id, c.slug")
            ->getQuery()->getArrayResult();
    }



    public function getCategorieContent()
    {
        $qb = $this->createQueryBuilder("c");
        $qb->select("group_concat(c.name) categorie_name, c.description categorie_description, c.id categorie_id, group_concat(c.slug) categorie_slug, 
        a.name article_name, a.content article_contenu, a.slug article_slug")
            ->leftJoin("c.categorie_articles","c_a")
            ->leftJoin("c_a.articles","a")
            ->groupBy("a")
            ->getQuery();
        $categories_content = $qb->getQuery()->getArrayResult();
        return $categories_content;
    }
}

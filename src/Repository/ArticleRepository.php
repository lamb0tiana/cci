<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function getArticles()
    {
        $qb     =   $this->createQueryBuilder("a");
        return $qb->select("a.name,a.content")->getQuery()->getArrayResult();
    }

    /**
     * Récupération article dans le meme categorie
     * @param string $category
     * @param string $article_slug
     * @return array
     */
    public function getRelatedArticleFromCategory(string $category_slug, string $article_slug = null)
    {
        $qb = $this->createQueryBuilder("a");
        $qb->select("a.name,a.content")
            ->join("a.article_categories","ac")
            ->join("ac.categories","c")
            ->where("c.name = :category_slug")
        ->setParameter("category_slug",$category_slug);


        if($article_slug)
        {
            $qb->andWhere("a.slug != :article_slug")
            ->setParameter("article_slug",$article_slug);
        }


        $qb->setMaxResults(5);

        return $qb->getQuery()->getArrayResult();
    }
}

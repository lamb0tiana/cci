<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ArticleController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em   = $em;
    }

    /**
     * @Route("/article/{categorie}/{article}", name="article", defaults={ "article": null})
     * @ParamConverter("categorie", options={"mapping":{"categorie":"slug"}})
     * @ParamConverter("article", options={"mapping":{"article":"slug"}})
     */
    public function categorie(Request $request, Categorie $categorie = null, Article $article = null)
    {
        if(!$categorie || !$article) return $this->redirectToRoute("home");
        return $this->render("app/content/article.html.twig", ["categorie" => $categorie,"article" => $article]);
    }


    /**
     * @Route("/related/{categorie}/{article}", name="related_article", defaults={"article": null})
     * @ParamConverter("categorie", options={"mapping":{"categorie":"slug"}})
     * @ParamConverter("article", options={"mapping":{"article":"slug"}})
     */
    public function relatedArticle(Request $request, string $categorie,string $article = null)
    {
        $related_article = $this->em->getRepository(Article::class)->getRelatedArticleFromCategory($categorie, $article);
        return new JsonResponse($related_article);
    }
}

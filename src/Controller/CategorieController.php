<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em   = $em;
    }

    /**
     * @Route("/categories/{categorie}", name="categorie", defaults={"categorie": null})
     * @ParamConverter("categorie", options={"mapping":{"categorie":"slug"}})
     */
    public function categorie(Request $request, Categorie $categorie = null)
    {
        if(!$categorie)
            return $this->redirectToRoute("home");

        return $this->render("app/content/articles.html.twig", ["categorie" => $categorie]);
    }
}

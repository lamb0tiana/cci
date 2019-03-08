<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em   = $em;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $categories = $this->em->getRepository(Categorie::class)->getCategorieContent();
        return $this->render('app/home/content.html.twig', [
            "categories_content" => $categories
        ]);
    }


    public function getCategories(Request $request)
    {
        $categories = $this->em->getRepository(Categorie::class)->getMenu();
        return new JsonResponse($categories);
    }
}

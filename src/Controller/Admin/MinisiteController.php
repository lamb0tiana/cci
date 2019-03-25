<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Minisite;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MinisiteController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class MinisiteController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em   = $em;
    }

    /**
     * @Route("/", name="admin_index")
     */
    public function index(Request $request)
    {
        $minisite_repository = $this->em->getRepository(Minisite::class);
        $all_minisites       = $minisite_repository->lists();
        return new JsonResponse($all_minisites);
    }
}

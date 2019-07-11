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

class SecurityController extends AbstractController
{

    /**
     * @Route("/identification", name="identification")
     */
    public function identification(Request $request, $from = null)
    {
        $from = $from ? $from : $request->attributes->get('_route');
        
            return $this->forward("FOSUserBundle:Security:login",["from" => $from]);
    }


}

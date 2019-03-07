<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ArticleSubscriber implements EventSubscriberInterface
{
    private $em ;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onPrepersist(GenericEvent $event,$a,$b)
    {

        $request = $event->getArgument("request");
        $subject = $event->getSubject();
        if($subject instanceof Article)
        {
            $article    = $request->request->get("article");
            $categories = array_key_exists("categories",$article) ? $article["categories"]["autocomplete"] : [];
            for($i =0 ; $i < count($categories) ; $i++)
            {
                $article_categorie = new ArticleCategorie();

                /** @var Categorie $categorie */
                $categorie         = $this->em->find(Categorie::class,$categories[$i]);
                $categorie->addCategorieArticle($article_categorie);
                $subject->addArticleCategory($article_categorie);

            }
        }
    }

    public function onPreEdit(GenericEvent $event)
    {
        $request = $event->getArgument("request");
        $subject = $event->getSubject();
        if($subject["name"] == "Article") {

        $i = "";
        }

    }

    public static function getSubscribedEvents()
    {
        return [
           EasyAdminEvents::PRE_PERSIST => 'onPrepersist',
//           EasyAdminEvents::POST_EDIT    => 'onPreEdit'
        ];
    }
}

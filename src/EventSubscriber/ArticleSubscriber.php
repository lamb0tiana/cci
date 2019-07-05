<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use App\Entity\Categorie;
use App\Entity\Image;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use FOS\CommentBundle\Event\ThreadEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use FOS\CommentBundle\Events;
use FOS\CommentBundle\Event\CommentEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ArticleSubscriber implements EventSubscriberInterface
{
    private $em ;
    private $authorizationChecker;
    public function __construct(EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->em = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
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

    public function onCommentPrePersist(CommentEvent $event)
    {


        if(!$this->authorizationChecker->isGranted("IS_AUTHENTICATED_FULLY"))
        {
            $this->em->detach($event->getComment());
            $this->em->detach($event->getComment()->getThread());
            die;
        }





    }
    public static function getSubscribedEvents()
    {
        return [
           EasyAdminEvents::PRE_PERSIST => 'onPrepersist',
            Events::COMMENT_PRE_PERSIST => 'onCommentPrePersist'
//           EasyAdminEvents::PRE_UPDATE    => 'onPreUpdate'
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: operateur
 * Date: 3/7/19
 * Time: 11:51 AM
 */

namespace App\Controller\EasyAdmin;

use App\Entity\ArticleCategorie;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
class ArticleController extends EasyAdminController
{

    protected function createEditForm($entity, array $entityProperties)
    {
        $request = $this->request;
        if($entity instanceof \App\Entity\Article)
        {
            if($request->isMethod("POST"))
            {
                $entity->getArticleCategories()->clear();
                $article    = $request->request->get("article");
                $categories = array_key_exists("categories",$article) ? $article["categories"]["autocomplete"]:[];
                for($i =0 ; $i < count($categories) ; $i++)
                {
                    $article_categorie = new ArticleCategorie();

                    /** @var Categorie $categorie */
                    $categorie         = $this->em->find(Categorie::class,$categories[$i]);
                    $categorie->addCategorieArticle($article_categorie);
                    $entity->addArticleCategory($article_categorie);

                }
            }
        }
        return parent::createEditForm($entity,$entityProperties);
    }

}
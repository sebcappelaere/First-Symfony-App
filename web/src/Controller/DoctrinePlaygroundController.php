<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DoctrinePlaygroundController
 * @package AppBundle\Controller
 *
 * @Route("/doctrine")
 */
class DoctrinePlaygroundController extends Controller
{
    /**
     * @Route("/insert-article")
     */
    public function insertArticleAction()
    {
        //Récupération d'une instance de ArticleRepository pour exécuter des requêtes SELECT
        $repo = $this->getDoctrine()->getRepository("AppBundle:Article");
        //Récupération de l'entity manager
        $em = $this->getDoctrine()->getManager();

        $title = "Symfony c'est super";

        //Recherche de l'article avant de le créer
        $search = $repo->findOneByTitle($title);

        $article = new Article();

        if(! $search){
            //Création d'un article
            $article->setTitle($title);
            $article->setText("le texte de l'article");
            $article->setCreatedAt(new \DateTime());

            //Gestion de la persistence
            $em->persist($article);

            //Finalisation de la transaction
            $em->flush();
        }

        //Suppression de l'article dont l'id est 2
        $article2 = $repo->find(2);
        if($article2){
            $em->remove($article2);
            $em->flush();
        }

        //Mise à jour de l'article dont l'id est 3
        $article3 = $repo->find(3);
        if($article3){
            $article3->setTitle("Symfony 3 c'est encore mieux");
            $em->persist($article3);
            $em->flush();
        }



        //Récupération de tous les articles

        $articles = $repo->findAll();

        return $this->render('AppBundle:DoctrinePlayground:insert_article.html.twig', array(
            "article" => $article,
            "allArticles" => $articles
        ));
    }

}

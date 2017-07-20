<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\Form\ArticleType;
use AppBundle\Form\TagType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

/**
 * Class BlogController
 * @package AppBundle\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractBlogController
{
    /**
     * @Route("/list", name="blog_list")
     */
    public function listAction()
    {
        $articleRepo = $this->getDoctrine()->getRepository("AppBundle:Article");
        $articleList = $articleRepo->getAllArticles()->getArrayResult();

        return $this->render('AppBundle:Blog:list.html.twig', array(
            "articleList" => $articleList
        ));
    }

    /**
     * @Route("/details/{id}", name="blog_details")
     */
    public function detailsAction(Article $article)
    {
        return $this->render('AppBundle:Blog:details.html.twig', array(
            "article" => $article
        ));
    }

    /**
     * Liste de post d'un tag passé en paramètre
     * @Route("/post-by-tag/{tag}", name="post_by_tag")
     */
    public function postByTagsAction($tag){
        $tagRepo = $this->getDoctrine()->getRepository("AppBundle:Article");
        $articleList = $tagRepo->getArticlesByTagName($tag);

        return $this->render('AppBundle:Blog:list.html.twig', array(
            "currentTag" => $tag,
            "articleList" => $articleList
        ));
    }

    /**
     * @Route("/new-tag", name="new_tag")
     */
    public function newTag(\Symfony\Component\HttpFoundation\Request $request){
        $tag = new Tag();
        //Création du formulaire en utilisant une fabrique de formulaire
        //matières premières : un nom de classe Type, une instance d'entité et un tableau d'options
        $form = $this->createForm(
            TagType::class,
            $tag,
            [
                "method" => "post"
            ]
        );

        //Injection des données postées dans le formulaire
        $form->handleRequest($request);

        //Persistence uniquement si le formulaire est soumis et si les tests de validation sont tous passés
        if($form->isSubmitted() && $form->isValid()){
            try{
                //Persistence de l'entité tag
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                //Ajout d'un message flash
                $this->addFlash("info","Votre tag a été enregistré");

                //Redirection vers le formulaire pour vider les données postées
                return $this->redirectToRoute('new_tag');
            } catch (UniqueConstraintViolationException $ex){
                $this->addFlash("info","Ce tag existe déjà dans la base de données!");
            }

        }

        return $this->render('AppBundle:Blog:new-tag.html.twig', [
            "formulaire" => $form->createView()
        ]);
    }

    /**
     * @Route("/new-article", name="new_article")
     */
    public function newArticleAction(\Symfony\Component\HttpFoundation\Request $request){
        //Instance de l'entité Article
        $article = new Article();

        //Présélection de l'auteur Victor Hugo dans le formulaire
        $authorRepo = $this->getDoctrine()->getRepository("AppBundle:Author");
        $hugo = $authorRepo->findOneByName("Victor Hugo");
        $article->setAuthor($hugo);

        //Création du formulaire
        $form = $this->createForm(
            ArticleType::class,
            $article,
            [
                "method" => "post"
            ]
        );

        //Injection des données postées dans le formulaire
        $form->handleRequest($request);

        //Persistence uniquement si le formulaire est soumis et si les tests de validation sont tous passés
        if ($form->isSubmitted() && $form->isValid()){
            try{
                //Persistence de l'entité Article
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                //Ajout d'un message flash
                $this->addFlash("info", "Votre article a été enregistré");

                //Redirection vers le formulaire pour vider les données postées
                return $this->redirectToRoute("new_article");
            } catch (UniqueConstraintViolationException $ex) {
                $this->addFlash("info", "Cet article existe déjà dans la base de données!");
            }
        }

        //Affichage de la vue avec le formulaire
        return $this->render(
            "AppBundle:Blog:new-article.html.twig",
            ["articleForm" => $form->createView()]
        );



    }

}

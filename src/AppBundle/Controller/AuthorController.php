<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class AuthorController
 * @package AppBundle\Controller
 * @Route("/author", name="author_home")
 */
class AuthorController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $author = $this->getUser();
        $articleList = $this->getDoctrine()
            ->getRepository("AppBundle:Article")
            ->findByAuthor($author);

        return $this->render('AppBundle:Author:index.html.twig', array(
            "articleList" => $articleList,
            "name" => $author->getName()
        ));
    }

}

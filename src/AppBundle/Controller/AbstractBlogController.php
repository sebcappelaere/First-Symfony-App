<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 29/06/2017
 * Time: 14:14
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractBlogController extends Controller
{
    private function getTags(){
        $tagRepo = $this->getDoctrine()->getRepository("AppBundle:Tag");
        return $tagRepo->getAllTagsWithArticlesCount();
    }

    private function getLastArticles($nbOfArticles, $tagName){
        $articleRepo = $this->getDoctrine()->getRepository("AppBundle:Article");
        return $articleRepo->getLastArticles($nbOfArticles, $tagName)->getArrayResult();
    }

    public function render($view, array $parameters = array (), Response $response = null)
    {
        $parameters["tags"] = $this->getTags();

        $tag = null;
        if (array_key_exists("currentTag", $parameters)){
            $tag = $parameters["currentTag"];
        }

        $parameters["lastArticles"] = $this->getLastArticles(2, $tag);

        return parent::render($view, $parameters, $response);
    }
}
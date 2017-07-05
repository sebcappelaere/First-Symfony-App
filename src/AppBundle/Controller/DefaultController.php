<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route(
     *     "/hello/{name}/{age}/{countryCode}",
     *     name="hello",
     *     defaults={"name":"world","age":"99","countryCode":"fr"},
     *     requirements={"age":"\d{1,3}", "countryCode":"fr|es|be"}
     *  )
     * @param $name
     * @param $age
     * @return Response
     */
    public function helloAction($name, $age, $countryCode){

        $nationality = [
            "fr" => "française",
            "es" => "espagnole",
            "be" => "belge"
        ];
        $response = new Response("Hello $name. Vous avez $age ans. Vous êtes de nationalité $nationality[$countryCode]");
        return $response;
    }

    /**
     * @Route("/login-admin", name="login_admin")
     */
    public function adminLoginAction(){

        return $this->render(
            "AppBundle:Default:login.html.twig",
            ["actionRoute" => "login_admin_check"]
        );
    }

    /**
     * @Route("/login-author", name="login_author")
     * @return Response
     */
    public function authorLoginAction(){

        return $this->render(
            "AppBundle:Default:login.html.twig",
            ["actionRoute" => "login_author_check"]
        );
    }
}

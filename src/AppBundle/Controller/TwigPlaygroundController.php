<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TwigPlaygroundController extends Controller
{
    /**
     * @Route("/playground", name="twig_playground")
     */
    public function playgroundAction()
    {
        $inventaire = [
            "un frigidaire",
            "un évier en fer",
            "un pistolet à gaufre",
            "et un raton laveur"
        ];

        $cave = [
            ["nom" => "Poully fumé", "origine" => "Bourgogne", "cepage" => "Chardonnay", "prix" => 12],
            ["nom" => "Mouton Cadet", "origine" => "Bordeaux", "cepage" => "Cabernet", "prix" => 35],
            ["nom" => "Arbois Pupillin", "origine" => "Arbois", "cepage" => "Chardonnay", "prix" => 20],
            ["nom" => "Vin jaune", "origine" => "Arbois", "cepage" => "Savagnin", "prix" => 28],
            ["nom" => "Nuit Saint Georges", "origine" => "Bourgogne", "cepage" => "Pinot noir", "prix" => 25]
        ];

        $personne = [
            "nom" => "Cappelaere",
            "prenom" => "Sébastien",
            "adresse" => [
                "voie" => "42 rue du 11 novembre",
                "code_postal" => "59250",
                "ville" => "Halluin"
            ]
        ];

        return $this->render('AppBundle:TwigPlayground:playground.html.twig', array(
            "nom" => "Eli Lotar",
            "now" => new \DateTime(),
            "inventaire" => $inventaire,
            "client" => $personne,
            "cave" => $cave
        ));
    }

}

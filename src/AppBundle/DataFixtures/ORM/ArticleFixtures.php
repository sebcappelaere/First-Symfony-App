<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 30/06/2017
 * Time: 14:18
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setAuthor($this->getReference("author_hugo"))
                ->setTitle("Les nouveautés de PHP 7")
                ->setText("Vous allez en prendre plein la vue");
        $article->addTag($this->getReference("tag_php"));
        $article->addTag($this->getReference("tag_prog"));
        $manager->persist($article);

        $article = new Article();
        $article->setAuthor($this->getReference("author_yourcenar"))
            ->setTitle("Javascript ES7")
            ->setText("Vous allez encore en prendre plein la vue");
        $article->addTag($this->getReference("tag_js"));
        $manager->persist($article);

        $article = new Article();
        $article->setAuthor($this->getReference("author_hugo"))
            ->setTitle("Les Misérables")
            ->setText("Lisez le pour savoir le détail");
        $article->addTag($this->getReference("tag_php"));
        $article->addTag($this->getReference("tag_angular"));
        $manager->persist($article);

        $article = new Article();
        $article->setAuthor($this->getReference("author_hugo"))
            ->setTitle("Qui a peur de Linux")
            ->setText("Tout va bien se passer");
        $article->addTag($this->getReference("tag_js"));
        $article->addTag($this->getReference("tag_php"));
        $article->addTag($this->getReference("tag_prog"));
        $article->addTag($this->getReference("tag_angular"));
        $manager->persist($article);

        $article = new Article();
        $article->setAuthor($this->getReference("author_yourcenar"))
            ->setTitle("Inoic c'est pratique")
            ->setText("Vous allez encore en prendre plein le contrôleur");
        $article->addTag($this->getReference("tag_js"));
        $article->addTag($this->getReference("tag_php"));
        $manager->persist($article);

        $article = new Article();
        $article->setAuthor($this->getReference("author_yourcenar"))
            ->setTitle("Se mettre à l'Angular sur le tard")
            ->setText("Il n'est jamais trop tard pour l'Angular");
        $article->addTag($this->getReference("tag_angular"));
        $article->addTag($this->getReference("tag_js"));
        $manager->persist($article);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
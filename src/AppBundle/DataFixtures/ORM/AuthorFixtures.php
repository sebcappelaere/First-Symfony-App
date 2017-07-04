<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 30/06/2017
 * Time: 13:49
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setName("Victor Hugo");
        $author->setEmail("miserable@ecrivain.com");
        $author->setGender("M");
        $author->setBirthDate(new \DateTime("today -150 year"));
        $manager->persist($author);
        $this->setReference("author_hugo",$author);

        $author = new Author();
        $author->setName("Marguerite Yourcenar");
        $author->setEmail("m.yourcenar@ecrivain.com");
        $author->setGender("F");
        $author->setBirthDate(new \DateTime("today -50 year"));
        $manager->persist($author);
        $this->setReference("author_yourcenar",$author);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
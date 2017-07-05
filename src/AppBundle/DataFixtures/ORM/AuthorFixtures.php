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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthorFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');

        $author = new Author();
        $author->setName("Victor Hugo");
        $author->setEmail("miserable@ecrivain.com");
        $author->setGender("M");
        $author->setBirthDate(new \DateTime("today -150 year"));

        $password = $encoder->encodePassword($author,'123');
        $author->setPassword($password);

        $manager->persist($author);
        $this->setReference("author_hugo",$author);

        $author = new Author();
        $author->setName("Marguerite Yourcenar");
        $author->setEmail("m.yourcenar@ecrivain.com");
        $author->setGender("F");
        $author->setBirthDate(new \DateTime("today -50 year"));
        $author->setPassword($password);
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

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container= $container;
    }
}
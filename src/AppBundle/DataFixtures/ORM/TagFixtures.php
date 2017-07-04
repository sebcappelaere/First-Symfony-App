<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 30/06/2017
 * Time: 13:49
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setTagName("PHP");
        $manager->persist($tag);
        $this->setReference("tag_php",$tag);

        $tag = new Tag();
        $tag->setTagName("Javascript");
        $manager->persist($tag);
        $this->setReference("tag_js",$tag);

        $tag = new Tag();
        $tag->setTagName("Angular JS");
        $manager->persist($tag);
        $this->setReference("tag_angular",$tag);

        $tag = new Tag();
        $tag->setTagName("Programmation");
        $manager->persist($tag);
        $this->setReference("tag_prog",$tag);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
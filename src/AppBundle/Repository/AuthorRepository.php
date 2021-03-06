<?php

namespace AppBundle\Repository;

/**
 * AuthorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AuthorRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Requête qui ne retourne que les auteurs de sexe féminin
     * utilisée pour filtrer dans la liste des auteurs
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getOnlyWomen(){
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->where("a.gender='F'");
        return $qb;
    }
}

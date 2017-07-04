<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
    public function getAllTagsWithArticlesCount(){
        $qb = $this->createQueryBuilder('t')
            ->select('t.tagName, count(a.id) as numberOfArticles')
            ->innerJoin('t.articles','a')
            ->groupBy('t.id');
        return $qb->getQuery()->getArrayResult();
    }
}

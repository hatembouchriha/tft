<?php
/**
 * Created by PhpStorm.
 * User: Bouchriha
 * Date: 03/04/2016
 * Time: 14:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ActualiteRepository extends EntityRepository
{
    public function findThree()
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
        $actualites = $query->getResult(Query::HYDRATE_OBJECT);
        return $actualites;
    }

    public function findFor()
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery();
        $actualites = $query->getResult(Query::HYDRATE_OBJECT);
        return $actualites;
    }

}

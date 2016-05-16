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

class JoueurRepository extends EntityRepository
{
    public function findAllOrderedByScore()
    {
        $query = $this->createQueryBuilder('j')
            ->orderBy('j.score', 'DESC')
            ->getQuery();
        $joueurs = $query->getResult(Query::HYDRATE_OBJECT);
        return $joueurs;
    }
    public function findFiveOrderedByScore()
    {
        $query = $this->createQueryBuilder('j')
            ->orderBy('j.score', 'DESC')
            ->setMaxResults(5)
            ->getQuery();
        $joueurs = $query->getResult(Query::HYDRATE_OBJECT);
        return $joueurs;
    }
    public function findTunisian()
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.nationalite = :nationalite')
            ->setParameter('nationalite', 'Tunisie')
            ->getQuery();
        $joueurs = $query->getResult(Query::HYDRATE_OBJECT);
        return $joueurs;
    }
    public function findTunisianOrderedByScore()
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.nationalite = :nationalite')
            ->orderBy('j.score', 'DESC')
            ->setParameter('nationalite', 'Tunisie')
            ->getQuery();
        $joueurs = $query->getResult(Query::HYDRATE_OBJECT);
        return $joueurs;
    }

    public function findFiveTunisian()
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.nationalite = :nationalite')
            ->orderBy('j.score', 'DESC')
            ->setParameter('nationalite', 'Tunisie')
            ->setMaxResults(5)
            ->getQuery();
        $joueurs = $query->getResult(Query::HYDRATE_OBJECT);
        return $joueurs;
    }

}

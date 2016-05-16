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

class MediaRepository extends EntityRepository
{
    public function findNine()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.genre = :genre')
            ->setParameter('genre', 'image')
            ->setMaxResults(9)
            ->getQuery();
        $images = $query->getResult(Query::HYDRATE_OBJECT);
        return $images;
    }
    public function findSixVideos()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.genre = :genre')
            ->setParameter('genre', 'video')
            ->setMaxResults(6)
            ->getQuery();
        $videos = $query->getResult(Query::HYDRATE_OBJECT);
        return $videos;
    }

    public function findEightImages()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.genre = :genre')
            ->orderBy('m.id', 'DESC')
            ->setParameter('genre', 'image')
            ->setMaxResults(8)
            ->getQuery();
        $images = $query->getResult(Query::HYDRATE_OBJECT);
        return $images;
    }

}

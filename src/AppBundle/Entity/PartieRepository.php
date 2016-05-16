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

class PartieRepository extends EntityRepository
{
    public function findCompleted()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.score != :score')
            ->setParameter('score', '*-*')
            ->getQuery();
        $matchs = $query->getResult(Query::HYDRATE_OBJECT);
        return $matchs;
    }

    public function findLast()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.score != :score')
            ->orderBy('m.id', 'DESC')
            ->setParameter('score', '*-*')
            ->setMaxResults(1)
            ->getQuery();
        $match = $query->getResult(Query::HYDRATE_OBJECT);
        return $match;
    }

    public function findNextMatches()
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.score = :score')
            ->setParameter('score', '*-*')
            ->getQuery();
        $matchs = $query->getResult(Query::HYDRATE_OBJECT);
        usort($matchs, array($this, 'comparer'));
        $matchs = array_slice($matchs, 0, 4);
        return $matchs;
    }

    public function findWinnedMatches($idJoueur)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT p
            FROM AppBundle:Partie p
            WHERE p.score != :score
            AND (p.idJoueurUn = :idJoueurUn OR p.idJoueurDeux = :idJoueurDeux)'
        )->setParameter('score', '*-*')
        ->setParameter('idJoueurUn', $idJoueur)
        ->setParameter('idJoueurDeux', $idJoueur);

        $matchs = $query->getResult();
        return $this->countWinned($matchs, $idJoueur);
    }

    public function comparer($match1, $match2)
    {
        $tab1 = preg_split("/-/", $match1->getDateMatch());
        $tab2 = preg_split("/-/", $match2->getDateMatch());
        $day1 = $tab1[0];
        $month1 = $tab1[1];
        $year1 = $tab1[2];
        $day2 = $tab2[0];
        $month2 = $tab2[1];
        $year2 = $tab2[2];
        if ($year1 < $year2) {
            return -1;
        } elseif ($year1 == $year2) {
            if ($month1 < $month2) {
                return -1;
            } elseif ($month1 == $month2) {
                if ($day1 < $day2) {
                    return -1;
                } elseif ($day1 == $day2) {
                    return 0;
                }
            }
        }
        return 1;
    }

    public function countWinned($matchs, $joueur)
    {
        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $may = 0;
        $jun = 0;
        $jul = 0;
        $aug = 0;
        $sep = 0;
        $oct = 0;
        $nov = 0;
        $dec = 0;

        foreach ($matchs as $match){
            if($this->isWinner($match, $joueur)){
                switch ($this->getMonth($match->getDateMatch())) {
                    case 1:
                        $jan++;
                        break;
                    case 2:
                        $feb++;
                        break;
                    case 3:
                        $mar++;
                        break;
                    case 4:
                        $apr++;
                        break;
                    case 5:
                        $may++;
                        break;
                    case 6:
                        $jun++;
                        break;
                    case 7:
                        $jul++;
                        break;
                    case 8:
                        $aug++;
                        break;
                    case 9:
                        $sep++;
                        break;
                    case 10:
                        $oct++;
                        break;
                    case 11:
                        $nov++;
                        break;
                    case 12:
                        $dec++;
                        break;
                }
            }
        }
        return array('jan' => $jan, 'feb' => $feb, 'mar' => $mar, 'apr' => $apr, 'may' => $may, 'jun' => $jun,
            'jul' => $jul, 'aug' => $aug, 'sep' => $sep, 'oct' => $oct, 'nov' => $nov, 'dec' => $dec);
    }

    public function isWinner($match, $joueur)
    {
        if ($this->isFirstWinner($match->getScore()) && $match->getIdJoueurUn()->getId() == $joueur) {
            return true;
        }
        if (!$this->isFirstWinner($match->getScore()) && $match->getIdJoueurDeux()->getId() == $joueur) {
            return true;
        }
        return false;
    }

    public function isFirstWinner($str)
    {
        $tab1 = preg_split("/-/", $str);
        if ($tab1[0] > $tab1[1]) {
            return true;
        }
        return false;
    }

    public function getMonth($str)
    {
        $tab1 = preg_split("/-/", $str);
        return $tab1[1];
    }

}

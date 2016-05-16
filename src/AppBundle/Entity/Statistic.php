<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic", indexes={@ORM\Index(name="id_match", columns={"id_match"}), @ORM\Index(name="id_joueur", columns={"id_joueur"})})
 * @ORM\Entity
 */
class Statistic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="aces", type="integer", nullable=false)
     */
    private $aces;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_winners", type="integer", nullable=false)
     */
    private $serviceWinners;

    /**
     * @var integer
     *
     * @ORM\Column(name="double_faults", type="integer", nullable=false)
     */
    private $doubleFaults;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_points", type="integer", nullable=false)
     */
    private $totalPoints;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_points_won", type="integer", nullable=false)
     */
    private $totalPointsWon;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_game", type="integer", nullable=false)
     */
    private $serviceGame;

    /**
     * @var float
     *
     * @ORM\Column(name="average_serve_speed", type="float", precision=10, scale=0, nullable=false)
     */
    private $averageServeSpeed;

    /**
     * @var float
     *
     * @ORM\Column(name="fastest_serve_speed", type="float", precision=10, scale=0, nullable=false)
     */
    private $fastestServeSpeed;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match", referencedColumnName="id")
     * })
     */
    private $idMatch;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur", referencedColumnName="id")
     * })
     */
    private $idJoueur;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set aces
     *
     * @param integer $aces
     * @return Statistic
     */
    public function setAces($aces)
    {
        $this->aces = $aces;

        return $this;
    }

    /**
     * Get aces
     *
     * @return integer 
     */
    public function getAces()
    {
        return $this->aces;
    }

    /**
     * Set serviceWinners
     *
     * @param integer $serviceWinners
     * @return Statistic
     */
    public function setServiceWinners($serviceWinners)
    {
        $this->serviceWinners = $serviceWinners;

        return $this;
    }

    /**
     * Get serviceWinners
     *
     * @return integer 
     */
    public function getServiceWinners()
    {
        return $this->serviceWinners;
    }

    /**
     * Set doubleFaults
     *
     * @param integer $doubleFaults
     * @return Statistic
     */
    public function setDoubleFaults($doubleFaults)
    {
        $this->doubleFaults = $doubleFaults;

        return $this;
    }

    /**
     * Get doubleFaults
     *
     * @return integer 
     */
    public function getDoubleFaults()
    {
        return $this->doubleFaults;
    }

    /**
     * Set totalPoints
     *
     * @param integer $totalPoints
     * @return Statistic
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return integer 
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * Set totalPointsWon
     *
     * @param integer $totalPointsWon
     * @return Statistic
     */
    public function setTotalPointsWon($totalPointsWon)
    {
        $this->totalPointsWon = $totalPointsWon;

        return $this;
    }

    /**
     * Get totalPointsWon
     *
     * @return integer 
     */
    public function getTotalPointsWon()
    {
        return $this->totalPointsWon;
    }

    /**
     * Set serviceGame
     *
     * @param integer $serviceGame
     * @return Statistic
     */
    public function setServiceGame($serviceGame)
    {
        $this->serviceGame = $serviceGame;

        return $this;
    }

    /**
     * Get serviceGame
     *
     * @return integer 
     */
    public function getServiceGame()
    {
        return $this->serviceGame;
    }

    /**
     * Set averageServeSpeed
     *
     * @param float $averageServeSpeed
     * @return Statistic
     */
    public function setAverageServeSpeed($averageServeSpeed)
    {
        $this->averageServeSpeed = $averageServeSpeed;

        return $this;
    }

    /**
     * Get averageServeSpeed
     *
     * @return float 
     */
    public function getAverageServeSpeed()
    {
        return $this->averageServeSpeed;
    }

    /**
     * Set fastestServeSpeed
     *
     * @param float $fastestServeSpeed
     * @return Statistic
     */
    public function setFastestServeSpeed($fastestServeSpeed)
    {
        $this->fastestServeSpeed = $fastestServeSpeed;

        return $this;
    }

    /**
     * Get fastestServeSpeed
     *
     * @return float 
     */
    public function getFastestServeSpeed()
    {
        return $this->fastestServeSpeed;
    }

    /**
     * Set idMatch
     *
     * @param \AppBundle\Entity\Partie $idMatch
     * @return Statistic
     */
    public function setIdMatch(\AppBundle\Entity\Partie $idMatch = null)
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    /**
     * Get idMatch
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * Set idJoueur
     *
     * @param \AppBundle\Entity\Joueur $idJoueur
     * @return Statistic
     */
    public function setIdJoueur(\AppBundle\Entity\Joueur $idJoueur = null)
    {
        $this->idJoueur = $idJoueur;

        return $this;
    }

    /**
     * Get idJoueur
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdJoueur()
    {
        return $this->idJoueur;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

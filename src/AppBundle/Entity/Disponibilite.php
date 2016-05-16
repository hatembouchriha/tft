<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibilite
 *
 * @ORM\Table(name="disponibilite", indexes={@ORM\Index(name="id_arbitre", columns={"id_arbitre"})})
 * @ORM\Entity
 */
class Disponibilite
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
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=20, nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=20, nullable=false)
     */
    private $time;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @var \Arbitre
     *
     * @ORM\ManyToOne(targetEntity="Arbitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_arbitre", referencedColumnName="id")
     * })
     */
    private $idArbitre;



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
     * Set date
     *
     * @param string $date
     * @return Disponibilite
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return Disponibilite
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return Disponibilite
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set idArbitre
     *
     * @param \AppBundle\Entity\Arbitre $idArbitre
     * @return Disponibilite
     */
    public function setIdArbitre(\AppBundle\Entity\Arbitre $idArbitre = null)
    {
        $this->idArbitre = $idArbitre;

        return $this;
    }

    /**
     * Get idArbitre
     *
     * @return \AppBundle\Entity\Arbitre 
     */
    public function getIdArbitre()
    {
        return $this->idArbitre;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

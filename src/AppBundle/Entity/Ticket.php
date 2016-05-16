<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket", indexes={@ORM\Index(name="id_match", columns={"id_match"}), @ORM\Index(name="id_fan", columns={"id_fan"})})
 * @ORM\Entity
 */
class Ticket
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
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

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
     * @var \Fan
     *
     * @ORM\ManyToOne(targetEntity="Fan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fan", referencedColumnName="id")
     * })
     */
    private $idFan;



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
     * Set etat
     *
     * @param boolean $etat
     * @return Ticket
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
     * Set idMatch
     *
     * @param \AppBundle\Entity\Partie $idMatch
     * @return Ticket
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
     * Set idFan
     *
     * @param \AppBundle\Entity\Fan $idFan
     * @return Ticket
     */
    public function setIdFan(\AppBundle\Entity\Fan $idFan = null)
    {
        $this->idFan = $idFan;

        return $this;
    }

    /**
     * Get idFan
     *
     * @return \AppBundle\Entity\Fan 
     */
    public function getIdFan()
    {
        return $this->idFan;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipationFormation
 *
 * @ORM\Table(name="participation_formation", indexes={@ORM\Index(name="id_arbitre", columns={"id_arbitre"}), @ORM\Index(name="id_formation", columns={"id_formation"})})
 * @ORM\Entity
 */
class ParticipationFormation
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
     * @var \Arbitre
     *
     * @ORM\ManyToOne(targetEntity="Arbitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_arbitre", referencedColumnName="id")
     * })
     */
    private $idArbitre;

    /**
     * @var \Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formation", referencedColumnName="id")
     * })
     */
    private $idFormation;



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
     * @return ParticipationFormation
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
     * @return ParticipationFormation
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

    /**
     * Set idFormation
     *
     * @param \AppBundle\Entity\Formation $idFormation
     * @return ParticipationFormation
     */
    public function setIdFormation(\AppBundle\Entity\Formation $idFormation = null)
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    /**
     * Get idFormation
     *
     * @return \AppBundle\Entity\Formation 
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

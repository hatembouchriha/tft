<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteRenduMatch
 *
 * @ORM\Table(name="compte_rendu_match", indexes={@ORM\Index(name="id_match", columns={"id_match"}), @ORM\Index(name="id_arbitre", columns={"id_arbitre"})})
 * @ORM\Entity
 */
class CompteRenduMatch
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
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

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
     * Set description
     *
     * @param string $description
     * @return CompteRenduMatch
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idMatch
     *
     * @param \AppBundle\Entity\Partie $idMatch
     * @return CompteRenduMatch
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
     * Set idArbitre
     *
     * @param \AppBundle\Entity\Arbitre $idArbitre
     * @return CompteRenduMatch
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

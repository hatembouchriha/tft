<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteRenduTest
 *
 * @ORM\Table(name="compte_rendu_test", indexes={@ORM\Index(name="id_medecin", columns={"id_medecin"}), @ORM\Index(name="id_responsable", columns={"id_responsable"}), @ORM\Index(name="id_joueur", columns={"id_joueur"})})
 * @ORM\Entity
 */
class CompteRenduTest
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
     * @var boolean
     *
     * @ORM\Column(name="resultat", type="boolean", nullable=false)
     */
    private $resultat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @var \Medecin
     *
     * @ORM\ManyToOne(targetEntity="Medecin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medecin", referencedColumnName="id")
     * })
     */
    private $idMedecin;

    /**
     * @var \Responsable
     *
     * @ORM\ManyToOne(targetEntity="Responsable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_responsable", referencedColumnName="id")
     * })
     */
    private $idResponsable;

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
     * Set description
     *
     * @param string $description
     * @return CompteRenduTest
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
     * Set resultat
     *
     * @param boolean $resultat
     * @return CompteRenduTest
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return boolean 
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return CompteRenduTest
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
     * Set idMedecin
     *
     * @param \AppBundle\Entity\Medecin $idMedecin
     * @return CompteRenduTest
     */
    public function setIdMedecin(\AppBundle\Entity\Medecin $idMedecin = null)
    {
        $this->idMedecin = $idMedecin;

        return $this;
    }

    /**
     * Get idMedecin
     *
     * @return \AppBundle\Entity\Medecin 
     */
    public function getIdMedecin()
    {
        return $this->idMedecin;
    }

    /**
     * Set idResponsable
     *
     * @param \AppBundle\Entity\Responsable $idResponsable
     * @return CompteRenduTest
     */
    public function setIdResponsable(\AppBundle\Entity\Responsable $idResponsable = null)
    {
        $this->idResponsable = $idResponsable;

        return $this;
    }

    /**
     * Get idResponsable
     *
     * @return \AppBundle\Entity\Responsable 
     */
    public function getIdResponsable()
    {
        return $this->idResponsable;
    }

    /**
     * Set idJoueur
     *
     * @param \AppBundle\Entity\Joueur $idJoueur
     * @return CompteRenduTest
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

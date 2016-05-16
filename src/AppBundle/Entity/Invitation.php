<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation", indexes={@ORM\Index(name="id_joueur", columns={"id_joueur"}), @ORM\Index(name="id_medecin", columns={"id_medecin"})})
 * @ORM\Entity
 */
class Invitation
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
     * @ORM\Column(name="date_invitation", type="string", length=20, nullable=false)
     */
    private $dateInvitation;

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
     * @var \Medecin
     *
     * @ORM\ManyToOne(targetEntity="Medecin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medecin", referencedColumnName="id")
     * })
     */
    private $idMedecin;



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
     * Set dateInvitation
     *
     * @param string $dateInvitation
     * @return Invitation
     */
    public function setDateInvitation($dateInvitation)
    {
        $this->dateInvitation = $dateInvitation->format('d-m-Y');

        return $this;
    }

    /**
     * Get dateInvitation
     *
     * @return string 
     */
    public function getDateInvitation()
    {
        return $this->dateInvitation;
    }

    /**
     * Set idJoueur
     *
     * @param \AppBundle\Entity\Joueur $idJoueur
     * @return Invitation
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

    /**
     * Set idMedecin
     *
     * @param \AppBundle\Entity\Medecin $idMedecin
     * @return Invitation
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

    function __toString()
    {
        return $this->id . "";
    }
}

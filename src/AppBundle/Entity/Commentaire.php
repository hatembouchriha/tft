<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="id_utilisateur", columns={"id_utilisateur"}), @ORM\Index(name="id_actualite", columns={"id_actualite"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=20, nullable=false)
     */
    private $date;

    /**
     * @var \Fan
     *
     * @ORM\ManyToOne(targetEntity="Fan", inversedBy="commentaires")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     * })
     */
    private $idUtilisateur;

    /**
     * @var \Actualite
     *
     * @ORM\ManyToOne(targetEntity="Actualite", inversedBy="commentaires")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actualite", referencedColumnName="id")
     * })
     */
    private $idActualite;


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
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date->format('d-m-Y');

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
     * Set idUtilisateur
     *
     * @param \AppBundle\Entity\Fan $idUtilisateur
     * @return Commentaire
     */
    public function setIdUtilisateur(\AppBundle\Entity\Fan $idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \AppBundle\Entity\Fan 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set idActualite
     *
     * @param \AppBundle\Entity\Actualite $idActualite
     * @return Commentaire
     */
    public function setIdActualite(\AppBundle\Entity\Actualite $idActualite = null)
    {
        $this->idActualite = $idActualite;

        return $this;
    }

    /**
     * Get idActualite
     *
     * @return \AppBundle\Entity\Actualite 
     */
    public function getIdActualite()
    {
        return $this->idActualite;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

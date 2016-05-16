<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="id_club", columns={"id_club"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\JoueurRepository")
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\User", message="fos_user.email.already_used")
 */
class Joueur extends User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance", type="string", length=20, nullable=false)
     */
    private $dateNaissance;

    /**
     * @var float
     *
     * @ORM\Column(name="taille", type="float", precision=10, scale=0, nullable=false)
     */
    private $taille;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids;

    /**
     * @var float
     *
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=false)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe_age", type="string", nullable=false)
     */
    private $groupeAge;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=100, nullable=false)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_pays", type="string", length=255, nullable=false)
     */
    private $logoPays;

    /**
     * @var \Club
     *
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club", referencedColumnName="id")
     * })
     */
    private $idClub;

    /**
     * Set nom
     *
     * @param string $nom
     * @return Joueur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Joueur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param string $dateNaissance
     * @return Joueur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance->format('d-m-Y');

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return string 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set taille
     *
     * @param float $taille
     * @return Joueur
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return float 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids
     *
     * @param float $poids
     * @return Joueur
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set score
     *
     * @param float $score
     * @return Joueur
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return float 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Joueur
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set groupeAge
     *
     * @param string $groupeAge
     * @return Joueur
     */
    public function setGroupeAge($groupeAge)
    {
        $this->groupeAge = $groupeAge;

        return $this;
    }

    /**
     * Get groupeAge
     *
     * @return string 
     */
    public function getGroupeAge()
    {
        return $this->groupeAge;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Joueur
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Joueur
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set logoPays
     *
     * @param string $logoPays
     * @return Joueur
     */
    public function setLogoPays($logoPays)
    {
        $this->logoPays = $logoPays;

        return $this;
    }

    /**
     * Get logoPays
     *
     * @return string 
     */
    public function getLogoPays()
    {
        return $this->logoPays;
    }

    /**
     * Set idClub
     *
     * @param \AppBundle\Entity\Club $idClub
     * @return Joueur
     */
    public function setIdClub(\AppBundle\Entity\Club $idClub = null)
    {
        $this->idClub = $idClub;

        return $this;
    }

    /**
     * Get idClub
     *
     * @return \AppBundle\Entity\Club 
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    function __toString()
    {
        return $this->nom. " ".$this->prenom;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="partie", indexes={@ORM\Index(name="id_stade", columns={"id_stade"}), @ORM\Index(name="id_evenement", columns={"id_evenement"}), @ORM\Index(name="id_arbitre", columns={"id_arbitre"}), @ORM\Index(name="id_joueur1", columns={"id_joueur_un", "id_joueur_deux", "id_joueur_trois", "id_joueur_quatre"}), @ORM\Index(name="id_joueur1_2", columns={"id_joueur_un"}), @ORM\Index(name="id_joueur2", columns={"id_joueur_deux"}), @ORM\Index(name="id_joueur3", columns={"id_joueur_trois"}), @ORM\Index(name="id_joueur4", columns={"id_joueur_quatre"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PartieRepository")
 */
class Partie
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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", nullable=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", nullable=false)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="set_un", type="string", length=10, nullable=false)
     */
    private $setUn;

    /**
     * @var string
     *
     * @ORM\Column(name="set_deux", type="string", length=10, nullable=false)
     */
    private $setDeux;

    /**
     * @var string
     *
     * @ORM\Column(name="set_trois", type="string", length=10, nullable=true)
     */
    private $setTrois;

    /**
     * @var string
     *
     * @ORM\Column(name="set_quatre", type="string", length=10, nullable=true)
     */
    private $setQuatre;

    /**
     * @var string
     *
     * @ORM\Column(name="set_cinq", type="string", length=10, nullable=true)
     */
    private $setCinq;

    /**
     * @var string
     *
     * @ORM\Column(name="date_match", type="string", length=20, nullable=false)
     */
    private $dateMatch;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=false)
     */
    private $lien;

    /**
     * @var \Stade
     *
     * @ORM\ManyToOne(targetEntity="Stade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stade", referencedColumnName="id")
     * })
     */
    private $idStade;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

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
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur_trois", referencedColumnName="id")
     * })
     */
    private $idJoueurTrois;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur_quatre", referencedColumnName="id")
     * })
     */
    private $idJoueurQuatre;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur_un", referencedColumnName="id")
     * })
     */
    private $idJoueurUn;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_joueur_deux", referencedColumnName="id")
     * })
     */
    private $idJoueurDeux;

    /**
     * @ORM\OneToMany(targetEntity="Statistic", mappedBy="idMatch", orphanRemoval=true, cascade={"all"})
     */
    private $statistics;

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
     * @return Partie
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
     * Set genre
     *
     * @param string $genre
     * @return Partie
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Partie
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Partie
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set setUn
     *
     * @param string $setUn
     * @return Partie
     */
    public function setSetUn($setUn)
    {
        $this->setUn = $setUn;

        return $this;
    }

    /**
     * Get setUn
     *
     * @return string 
     */
    public function getSetUn()
    {
        return $this->setUn;
    }

    /**
     * Set setDeux
     *
     * @param string $setDeux
     * @return Partie
     */
    public function setSetDeux($setDeux)
    {
        $this->setDeux = $setDeux;

        return $this;
    }

    /**
     * Get setDeux
     *
     * @return string 
     */
    public function getSetDeux()
    {
        return $this->setDeux;
    }

    /**
     * Set setTrois
     *
     * @param string $setTrois
     * @return Partie
     */
    public function setSetTrois($setTrois)
    {
        $this->setTrois = $setTrois;

        return $this;
    }

    /**
     * Get setTrois
     *
     * @return string 
     */
    public function getSetTrois()
    {
        return $this->setTrois;
    }

    /**
     * Set setQuatre
     *
     * @param string $setQuatre
     * @return Partie
     */
    public function setSetQuatre($setQuatre)
    {
        $this->setQuatre = $setQuatre;

        return $this;
    }

    /**
     * Get setQuatre
     *
     * @return string 
     */
    public function getSetQuatre()
    {
        return $this->setQuatre;
    }

    /**
     * Set setCinq
     *
     * @param string $setCinq
     * @return Partie
     */
    public function setSetCinq($setCinq)
    {
        $this->setCinq = $setCinq;

        return $this;
    }

    /**
     * Get setCinq
     *
     * @return string 
     */
    public function getSetCinq()
    {
        return $this->setCinq;
    }

    /**
     * Set dateMatch
     *
     * @param string $dateMatch
     * @return Partie
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch->format('d-m-Y');

        return $this;
    }

    /**
     * Get dateMatch
     *
     * @return string 
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Partie
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set idStade
     *
     * @param \AppBundle\Entity\Stade $idStade
     * @return Partie
     */
    public function setIdStade(\AppBundle\Entity\Stade $idStade = null)
    {
        $this->idStade = $idStade;

        return $this;
    }

    /**
     * Get idStade
     *
     * @return \AppBundle\Entity\Stade 
     */
    public function getIdStade()
    {
        return $this->idStade;
    }

    /**
     * Set idEvenement
     *
     * @param \AppBundle\Entity\Evenement $idEvenement
     * @return Partie
     */
    public function setIdEvenement(\AppBundle\Entity\Evenement $idEvenement = null)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return \AppBundle\Entity\Evenement 
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idArbitre
     *
     * @param \AppBundle\Entity\Arbitre $idArbitre
     * @return Partie
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
     * Set idJoueurTrois
     *
     * @param \AppBundle\Entity\Joueur $idJoueurTrois
     * @return Partie
     */
    public function setIdJoueurTrois(\AppBundle\Entity\Joueur $idJoueurTrois = null)
    {
        $this->idJoueurTrois = $idJoueurTrois;

        return $this;
    }

    /**
     * Get idJoueurTrois
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdJoueurTrois()
    {
        return $this->idJoueurTrois;
    }

    /**
     * Set idJoueurQuatre
     *
     * @param \AppBundle\Entity\Joueur $idJoueurQuatre
     * @return Partie
     */
    public function setIdJoueurQuatre(\AppBundle\Entity\Joueur $idJoueurQuatre = null)
    {
        $this->idJoueurQuatre = $idJoueurQuatre;

        return $this;
    }

    /**
     * Get idJoueurQuatre
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdJoueurQuatre()
    {
        return $this->idJoueurQuatre;
    }

    /**
     * Set idJoueurUn
     *
     * @param \AppBundle\Entity\Joueur $idJoueurUn
     * @return Partie
     */
    public function setIdJoueurUn(\AppBundle\Entity\Joueur $idJoueurUn = null)
    {
        $this->idJoueurUn = $idJoueurUn;

        return $this;
    }

    /**
     * Get idJoueurUn
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdJoueurUn()
    {
        return $this->idJoueurUn;
    }

    /**
     * Set idJoueurDeux
     *
     * @param \AppBundle\Entity\Joueur $idJoueurDeux
     * @return Partie
     */
    public function setIdJoueurDeux(\AppBundle\Entity\Joueur $idJoueurDeux = null)
    {
        $this->idJoueurDeux = $idJoueurDeux;

        return $this;
    }

    /**
     * Get idJoueurDeux
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdJoueurDeux()
    {
        return $this->idJoueurDeux;
    }

    function __toString()
    {
        return $this->id . "";
    }

    /**
     * @return mixed
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * @param mixed $statistics
     */
    public function setStatistics($statistics)
    {
        $this->statistics = $statistics;
    }

}

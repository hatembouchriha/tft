<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pronostic
 *
 * @ORM\Table(name="pronostic", indexes={@ORM\Index(name="id_joueur", columns={"id_gagnant1"}), @ORM\Index(name="id_match", columns={"id_match1"}), @ORM\Index(name="id_fan", columns={"id_fan"}), @ORM\Index(name="id_match2", columns={"id_match2"}), @ORM\Index(name="id_gagnant2", columns={"id_gagnant2"}), @ORM\Index(name="id_match3", columns={"id_match3"}), @ORM\Index(name="id_gagnant3", columns={"id_gagnant3"}), @ORM\Index(name="id_match4", columns={"id_match4"}), @ORM\Index(name="id_gagnant4", columns={"id_gagnant4"}), @ORM\Index(name="id_match5", columns={"id_match5"}), @ORM\Index(name="id_gagnant5", columns={"id_gagnant5"}), @ORM\Index(name="id_match6", columns={"id_match6"}), @ORM\Index(name="id_gagnant6", columns={"id_gagnant6"}), @ORM\Index(name="id_match7", columns={"id_match7"}), @ORM\Index(name="id_gagnant7", columns={"id_gagnant7"}), @ORM\Index(name="id_match8", columns={"id_match8"}), @ORM\Index(name="id_gagnant8", columns={"id_gagnant8"}), @ORM\Index(name="id_match9", columns={"id_match9"}), @ORM\Index(name="id_gagnant9", columns={"id_gagnant9"}), @ORM\Index(name="id_match10", columns={"id_match10"}), @ORM\Index(name="id_gagnant10", columns={"id_gagnant10"}), @ORM\Index(name="id_match11", columns={"id_match11"}), @ORM\Index(name="id_gagnant11", columns={"id_gagnant11"}), @ORM\Index(name="id_match12", columns={"id_match12"}), @ORM\Index(name="id_gagnant12", columns={"id_gagnant12"})})
 * @ORM\Entity
 */
class Pronostic
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
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant1", referencedColumnName="id")
     * })
     */
    private $idGagnant1;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match5", referencedColumnName="id")
     * })
     */
    private $idMatch5;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant5", referencedColumnName="id")
     * })
     */
    private $idGagnant5;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match6", referencedColumnName="id")
     * })
     */
    private $idMatch6;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant6", referencedColumnName="id")
     * })
     */
    private $idGagnant6;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match7", referencedColumnName="id")
     * })
     */
    private $idMatch7;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant7", referencedColumnName="id")
     * })
     */
    private $idGagnant7;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match8", referencedColumnName="id")
     * })
     */
    private $idMatch8;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant8", referencedColumnName="id")
     * })
     */
    private $idGagnant8;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match9", referencedColumnName="id")
     * })
     */
    private $idMatch9;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant9", referencedColumnName="id")
     * })
     */
    private $idGagnant9;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match1", referencedColumnName="id")
     * })
     */
    private $idMatch1;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match10", referencedColumnName="id")
     * })
     */
    private $idMatch10;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant10", referencedColumnName="id")
     * })
     */
    private $idGagnant10;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match11", referencedColumnName="id")
     * })
     */
    private $idMatch11;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant11", referencedColumnName="id")
     * })
     */
    private $idGagnant11;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match12", referencedColumnName="id")
     * })
     */
    private $idMatch12;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant12", referencedColumnName="id")
     * })
     */
    private $idGagnant12;

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
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match2", referencedColumnName="id")
     * })
     */
    private $idMatch2;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant2", referencedColumnName="id")
     * })
     */
    private $idGagnant2;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match3", referencedColumnName="id")
     * })
     */
    private $idMatch3;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant3", referencedColumnName="id")
     * })
     */
    private $idGagnant3;

    /**
     * @var \Partie
     *
     * @ORM\ManyToOne(targetEntity="Partie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_match4", referencedColumnName="id")
     * })
     */
    private $idMatch4;

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gagnant4", referencedColumnName="id")
     * })
     */
    private $idGagnant4;



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
     * Set idGagnant1
     *
     * @param \AppBundle\Entity\Joueur $idGagnant1
     * @return Pronostic
     */
    public function setIdGagnant1(\AppBundle\Entity\Joueur $idGagnant1 = null)
    {
        $this->idGagnant1 = $idGagnant1;

        return $this;
    }

    /**
     * Get idGagnant1
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant1()
    {
        return $this->idGagnant1;
    }

    /**
     * Set idMatch5
     *
     * @param \AppBundle\Entity\Partie $idMatch5
     * @return Pronostic
     */
    public function setIdMatch5(\AppBundle\Entity\Partie $idMatch5 = null)
    {
        $this->idMatch5 = $idMatch5;

        return $this;
    }

    /**
     * Get idMatch5
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch5()
    {
        return $this->idMatch5;
    }

    /**
     * Set idGagnant5
     *
     * @param \AppBundle\Entity\Joueur $idGagnant5
     * @return Pronostic
     */
    public function setIdGagnant5(\AppBundle\Entity\Joueur $idGagnant5 = null)
    {
        $this->idGagnant5 = $idGagnant5;

        return $this;
    }

    /**
     * Get idGagnant5
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant5()
    {
        return $this->idGagnant5;
    }

    /**
     * Set idMatch6
     *
     * @param \AppBundle\Entity\Partie $idMatch6
     * @return Pronostic
     */
    public function setIdMatch6(\AppBundle\Entity\Partie $idMatch6 = null)
    {
        $this->idMatch6 = $idMatch6;

        return $this;
    }

    /**
     * Get idMatch6
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch6()
    {
        return $this->idMatch6;
    }

    /**
     * Set idGagnant6
     *
     * @param \AppBundle\Entity\Joueur $idGagnant6
     * @return Pronostic
     */
    public function setIdGagnant6(\AppBundle\Entity\Joueur $idGagnant6 = null)
    {
        $this->idGagnant6 = $idGagnant6;

        return $this;
    }

    /**
     * Get idGagnant6
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant6()
    {
        return $this->idGagnant6;
    }

    /**
     * Set idMatch7
     *
     * @param \AppBundle\Entity\Partie $idMatch7
     * @return Pronostic
     */
    public function setIdMatch7(\AppBundle\Entity\Partie $idMatch7 = null)
    {
        $this->idMatch7 = $idMatch7;

        return $this;
    }

    /**
     * Get idMatch7
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch7()
    {
        return $this->idMatch7;
    }

    /**
     * Set idGagnant7
     *
     * @param \AppBundle\Entity\Joueur $idGagnant7
     * @return Pronostic
     */
    public function setIdGagnant7(\AppBundle\Entity\Joueur $idGagnant7 = null)
    {
        $this->idGagnant7 = $idGagnant7;

        return $this;
    }

    /**
     * Get idGagnant7
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant7()
    {
        return $this->idGagnant7;
    }

    /**
     * Set idMatch8
     *
     * @param \AppBundle\Entity\Partie $idMatch8
     * @return Pronostic
     */
    public function setIdMatch8(\AppBundle\Entity\Partie $idMatch8 = null)
    {
        $this->idMatch8 = $idMatch8;

        return $this;
    }

    /**
     * Get idMatch8
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch8()
    {
        return $this->idMatch8;
    }

    /**
     * Set idGagnant8
     *
     * @param \AppBundle\Entity\Joueur $idGagnant8
     * @return Pronostic
     */
    public function setIdGagnant8(\AppBundle\Entity\Joueur $idGagnant8 = null)
    {
        $this->idGagnant8 = $idGagnant8;

        return $this;
    }

    /**
     * Get idGagnant8
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant8()
    {
        return $this->idGagnant8;
    }

    /**
     * Set idMatch9
     *
     * @param \AppBundle\Entity\Partie $idMatch9
     * @return Pronostic
     */
    public function setIdMatch9(\AppBundle\Entity\Partie $idMatch9 = null)
    {
        $this->idMatch9 = $idMatch9;

        return $this;
    }

    /**
     * Get idMatch9
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch9()
    {
        return $this->idMatch9;
    }

    /**
     * Set idGagnant9
     *
     * @param \AppBundle\Entity\Joueur $idGagnant9
     * @return Pronostic
     */
    public function setIdGagnant9(\AppBundle\Entity\Joueur $idGagnant9 = null)
    {
        $this->idGagnant9 = $idGagnant9;

        return $this;
    }

    /**
     * Get idGagnant9
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant9()
    {
        return $this->idGagnant9;
    }

    /**
     * Set idMatch1
     *
     * @param \AppBundle\Entity\Partie $idMatch1
     * @return Pronostic
     */
    public function setIdMatch1(\AppBundle\Entity\Partie $idMatch1 = null)
    {
        $this->idMatch1 = $idMatch1;

        return $this;
    }

    /**
     * Get idMatch1
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch1()
    {
        return $this->idMatch1;
    }

    /**
     * Set idMatch10
     *
     * @param \AppBundle\Entity\Partie $idMatch10
     * @return Pronostic
     */
    public function setIdMatch10(\AppBundle\Entity\Partie $idMatch10 = null)
    {
        $this->idMatch10 = $idMatch10;

        return $this;
    }

    /**
     * Get idMatch10
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch10()
    {
        return $this->idMatch10;
    }

    /**
     * Set idGagnant10
     *
     * @param \AppBundle\Entity\Joueur $idGagnant10
     * @return Pronostic
     */
    public function setIdGagnant10(\AppBundle\Entity\Joueur $idGagnant10 = null)
    {
        $this->idGagnant10 = $idGagnant10;

        return $this;
    }

    /**
     * Get idGagnant10
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant10()
    {
        return $this->idGagnant10;
    }

    /**
     * Set idMatch11
     *
     * @param \AppBundle\Entity\Partie $idMatch11
     * @return Pronostic
     */
    public function setIdMatch11(\AppBundle\Entity\Partie $idMatch11 = null)
    {
        $this->idMatch11 = $idMatch11;

        return $this;
    }

    /**
     * Get idMatch11
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch11()
    {
        return $this->idMatch11;
    }

    /**
     * Set idGagnant11
     *
     * @param \AppBundle\Entity\Joueur $idGagnant11
     * @return Pronostic
     */
    public function setIdGagnant11(\AppBundle\Entity\Joueur $idGagnant11 = null)
    {
        $this->idGagnant11 = $idGagnant11;

        return $this;
    }

    /**
     * Get idGagnant11
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant11()
    {
        return $this->idGagnant11;
    }

    /**
     * Set idMatch12
     *
     * @param \AppBundle\Entity\Partie $idMatch12
     * @return Pronostic
     */
    public function setIdMatch12(\AppBundle\Entity\Partie $idMatch12 = null)
    {
        $this->idMatch12 = $idMatch12;

        return $this;
    }

    /**
     * Get idMatch12
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch12()
    {
        return $this->idMatch12;
    }

    /**
     * Set idGagnant12
     *
     * @param \AppBundle\Entity\Joueur $idGagnant12
     * @return Pronostic
     */
    public function setIdGagnant12(\AppBundle\Entity\Joueur $idGagnant12 = null)
    {
        $this->idGagnant12 = $idGagnant12;

        return $this;
    }

    /**
     * Get idGagnant12
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant12()
    {
        return $this->idGagnant12;
    }

    /**
     * Set idFan
     *
     * @param \AppBundle\Entity\Fan $idFan
     * @return Pronostic
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

    /**
     * Set idMatch2
     *
     * @param \AppBundle\Entity\Partie $idMatch2
     * @return Pronostic
     */
    public function setIdMatch2(\AppBundle\Entity\Partie $idMatch2 = null)
    {
        $this->idMatch2 = $idMatch2;

        return $this;
    }

    /**
     * Get idMatch2
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch2()
    {
        return $this->idMatch2;
    }

    /**
     * Set idGagnant2
     *
     * @param \AppBundle\Entity\Joueur $idGagnant2
     * @return Pronostic
     */
    public function setIdGagnant2(\AppBundle\Entity\Joueur $idGagnant2 = null)
    {
        $this->idGagnant2 = $idGagnant2;

        return $this;
    }

    /**
     * Get idGagnant2
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant2()
    {
        return $this->idGagnant2;
    }

    /**
     * Set idMatch3
     *
     * @param \AppBundle\Entity\Partie $idMatch3
     * @return Pronostic
     */
    public function setIdMatch3(\AppBundle\Entity\Partie $idMatch3 = null)
    {
        $this->idMatch3 = $idMatch3;

        return $this;
    }

    /**
     * Get idMatch3
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch3()
    {
        return $this->idMatch3;
    }

    /**
     * Set idGagnant3
     *
     * @param \AppBundle\Entity\Joueur $idGagnant3
     * @return Pronostic
     */
    public function setIdGagnant3(\AppBundle\Entity\Joueur $idGagnant3 = null)
    {
        $this->idGagnant3 = $idGagnant3;

        return $this;
    }

    /**
     * Get idGagnant3
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant3()
    {
        return $this->idGagnant3;
    }

    /**
     * Set idMatch4
     *
     * @param \AppBundle\Entity\Partie $idMatch4
     * @return Pronostic
     */
    public function setIdMatch4(\AppBundle\Entity\Partie $idMatch4 = null)
    {
        $this->idMatch4 = $idMatch4;

        return $this;
    }

    /**
     * Get idMatch4
     *
     * @return \AppBundle\Entity\Partie 
     */
    public function getIdMatch4()
    {
        return $this->idMatch4;
    }

    /**
     * Set idGagnant4
     *
     * @param \AppBundle\Entity\Joueur $idGagnant4
     * @return Pronostic
     */
    public function setIdGagnant4(\AppBundle\Entity\Joueur $idGagnant4 = null)
    {
        $this->idGagnant4 = $idGagnant4;

        return $this;
    }

    /**
     * Get idGagnant4
     *
     * @return \AppBundle\Entity\Joueur 
     */
    public function getIdGagnant4()
    {
        return $this->idGagnant4;
    }

    function __toString()
    {
        return $this->id . "";
    }
}

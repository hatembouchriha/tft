<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don", indexes={@ORM\Index(name="id_club", columns={"id_club"})})
 * @ORM\Entity
 */
class Don
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
     * @ORM\Column(name="date_don", type="string", length=20, nullable=false)
     */
    private $dateDon;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDon
     *
     * @param string $dateDon
     * @return Don
     */
    public function setDateDon($dateDon)
    {
        $this->dateDon = $dateDon->format('d-m-Y');

        return $this;
    }

    /**
     * Get dateDon
     *
     * @return string 
     */
    public function getDateDon()
    {
        return $this->dateDon;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Don
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
     * Set idClub
     *
     * @param \AppBundle\Entity\Club $idClub
     * @return Don
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
        return $this->id . "";
    }
}

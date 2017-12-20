<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Uzsakymas
 *
 * @ORM\Table(name="uzsakymas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UzsakymasRepository")
 */
class Uzsakymas
{

    /**
     * @ORM\OneToMany(targetEntity="Siuntinys", mappedBy="uzsakymas", cascade={"remove"})
     */
    private $siuntiniai;
    /**
     * @ORM\ManyToOne(targetEntity="uzsakymo_busena", inversedBy="uzsakymai")
     * @ORM\JoinColumn(name="uzsakymo_busena", referencedColumnName="id")
     */
    private $uzsakymo_busena;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="uzsakymai")
     * @ORM\JoinColumn(name="vartotojo_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="perdavimo_tipas", inversedBy="uzsakymai")
     * @ORM\JoinColumn(name="perdavimo_tipas", referencedColumnName="id")
     */
    private $perdavimo_tipas;

    /**
     * @ORM\OneToOne(targetEntity="Apmokejimas", inversedBy="uzsakymas")
     * @ORM\JoinColumn(name="apmokejimo_id", referencedColumnName="id")
     */
    protected $apmokejimas;
    /**
     * @ORM\OneToMany(targetEntity="Darbas", mappedBy="uzsakymas", cascade={"remove"})
     */
    private $darbai;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gavejo_adresas", type="string", length=255)
     */
    private $gavejoAdresas;

    /**
     * @var string
     *
     * @ORM\Column(name="siuntejo_adresas", type="string", length=255)
     */
    private $siuntejoAdresas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gavimo_data", type="date", nullable=true)
     */
    private $gavimoData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uzsakymo_data", type="datetime", nullable=true)
     */
    private $uzsakymoData;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gavejoAdresas
     *
     * @param string $gavejoAdresas
     *
     * @return Uzsakymas
     */
    public function setGavejoAdresas($gavejoAdresas)
    {
        $this->gavejoAdresas = $gavejoAdresas;

        return $this;
    }

    /**
     * Get gavejoAdresas
     *
     * @return string
     */
    public function getGavejoAdresas()
    {
        return $this->gavejoAdresas;
    }

    /**
     * Set siuntejoAdresas
     *
     * @param string $siuntejoAdresas
     *
     * @return Uzsakymas
     */
    public function setSiuntejoAdresas($siuntejoAdresas)
    {
        $this->siuntejoAdresas = $siuntejoAdresas;

        return $this;
    }

    /**
     * Get siuntejoAdresas
     *
     * @return string
     */
    public function getSiuntejoAdresas()
    {
        return $this->siuntejoAdresas;
    }

    /**
     * Set gavimoData
     *
     * @param \DateTime $gavimoData
     *
     * @return Uzsakymas
     */
    public function setGavimoData($gavimoData)
    {
        $this->gavimoData = $gavimoData;

        return $this;
    }

    /**
     * Get gavimoData
     *
     * @return \DateTime
     */
    public function getGavimoData()
    {
        return $this->gavimoData;
    }

    /**
     * Set uzsakymoData
     *
     * @param \DateTime $uzsakymoData
     *
     * @return Uzsakymas
     */
    public function setUzsakymoData($uzsakymoData)
    {
        $this->uzsakymoData = $uzsakymoData;

        return $this;
    }

    /**
     * Get uzsakymoData
     *
     * @return \DateTime
     */
    public function getUzsakymoData()
    {
        return $this->uzsakymoData;
    }

    public function __construct()
    {
        $this->darbai = new ArrayCollection();
        $this->siuntiniai = new ArrayCollection();
    }
    /**
     * Add darbas
     *
     * @param \AppBundle\Entity\Darbas $darbas
     *
     * @return Uzsakymas
     */
    public function addDarbas(\AppBundle\Entity\Darbas $darbas)
    {
        $this->darbai[] = $darbas;
        return $this;
    }
    /**
     * Remove darbas
     *
     * @param \AppBundle\Entity\Darbas $darbas
     */
    public function removeDarbas(\AppBundle\Entity\Darbas $darbas)
    {
        $this->darbai->removeElement($darbas);
    }
    /**
     * Get darbas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDarbai()
    {
        return $this->darbai;
    }

    /**
     * Add siuntinys
     *
     * @param \AppBundle\Entity\Siuntinys $siuntinys
     *
     * @return Uzsakymas
     */
    public function addSiuntinys(\AppBundle\Entity\Siuntinys $siuntinys)
    {
        $this->siuntiniai[] = $siuntinys;
        return $this;
    }
    /**
     * Remove siuntinys
     *
     * @param \AppBundle\Entity\Siuntinys $siuntinys
     */
    public function removeSiuntinys(\AppBundle\Entity\Siuntinys $siuntinys)
    {
        $this->darbai->removeElement($siuntinys);
    }
    /**
     * Get siuntinys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSiuntiniai()
    {
        return $this->siuntiniai;
    }

    /**
     * Set apmokejimas
     *
     * @param \AppBundle\Entity\Apmokejimas $apmokejimas
     *
     * @return Uzsakymas
     */
    public function setApmokejimas(\AppBundle\Entity\Apmokejimas $apmokejimas = null)
    {
        $this->apmokejimas = $apmokejimas;
        return $this;
    }
    /**
     * Get apmokejimas
     *
     * @return \AppBundle\Entity\Apmokejimas
     */
    public function getApmokejimas()
    {
        return $this->apmokejimas;
    }

    /**
     * Set perdavimo_tipas
     *
     * @param \AppBundle\Entity\perdavimo_tipas $perdavimo_tipas
     *
     * @return Uzsakymas
     */
    public function setPerdavimoTipas(\AppBundle\Entity\perdavimo_tipas $perdavimo_tipas = null)
    {
        $this->perdavimo_tipas = $perdavimo_tipas;
        return $this;
    }
    /**
     * Get perdavimo_tipas
     *
     * @return \AppBundle\Entity\perdavimo_tipas
     */
    public function getPerdavimoTipas()
    {
        return $this->perdavimo_tipas;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Uzsakymas
     */
    public function setVartotojas(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getVartotojas()
    {
        return $this->user;
    }

    /**
     * Set uzsakymo_busena
     *
     * @param \AppBundle\Entity\uzsakymo_busena $uzsakymo_busena
     *
     * @return Uzsakymas
     */
    public function setUzsakymoBusena(\AppBundle\Entity\uzsakymo_busena $uzsakymo_busena = null)
    {
        $this->uzsakymo_busena = $uzsakymo_busena;
        return $this;
    }
    /**
     * Get uzsakymo_busena
     *
     * @return \AppBundle\Entity\uzsakymo_busena
     */
    public function getUzsakymoBusena()
    {
        return $this->uzsakymo_busena;
    }

}


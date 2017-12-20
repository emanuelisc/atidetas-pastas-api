<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Siuntinys
 *
 * @ORM\Table(name="siuntinys")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SiuntinysRepository")
 */
class Siuntinys
{

    /**
     * @ORM\ManyToOne(targetEntity="Uzsakymas", inversedBy="siuntiniai")
     * @ORM\JoinColumn(name="uzsakymo_id", referencedColumnName="id")
     */
    private $uzsakymas;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="aukstis", type="float")
     */
    private $aukstis;

    /**
     * @var float
     *
     * @ORM\Column(name="plotis", type="float")
     */
    private $plotis;

    /**
     * @var float
     *
     * @ORM\Column(name="ilgis", type="float")
     */
    private $ilgis;

    /**
     * @var float
     *
     * @ORM\Column(name="svoris", type="float")
     */
    private $svoris;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sandelio_pasiekimo_data", type="datetime", nullable=true)
     */
    private $sandelioPasiekimoData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sandelio_palikimo_data", type="datetime", nullable=true)
     */
    private $sandelioPalikimoData;

    /**
     * @var bool
     *
     * @ORM\Column(name="yra_sandelyje", type="boolean")
     */
    private $yraSandelyje;


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
     * Set aukstis
     *
     * @param float $aukstis
     *
     * @return Siuntinys
     */
    public function setAukstis($aukstis)
    {
        $this->aukstis = $aukstis;

        return $this;
    }

    /**
     * Get aukstis
     *
     * @return float
     */
    public function getAukstis()
    {
        return $this->aukstis;
    }

    /**
     * Set plotis
     *
     * @param float $plotis
     *
     * @return Siuntinys
     */
    public function setPlotis($plotis)
    {
        $this->plotis = $plotis;

        return $this;
    }

    /**
     * Get plotis
     *
     * @return float
     */
    public function getPlotis()
    {
        return $this->plotis;
    }

    /**
     * Set ilgis
     *
     * @param float $ilgis
     *
     * @return Siuntinys
     */
    public function setIlgis($ilgis)
    {
        $this->ilgis = $ilgis;

        return $this;
    }

    /**
     * Get ilgis
     *
     * @return float
     */
    public function getIlgis()
    {
        return $this->ilgis;
    }

    /**
     * Set svoris
     *
     * @param float $svoris
     *
     * @return Siuntinys
     */
    public function setSvoris($svoris)
    {
        $this->svoris = $svoris;

        return $this;
    }

    /**
     * Get svoris
     *
     * @return float
     */
    public function getSvoris()
    {
        return $this->svoris;
    }

    /**
     * Set sandelioPasiekimoData
     *
     * @param \DateTime $sandelioPasiekimoData
     *
     * @return Siuntinys
     */
    public function setSandelioPasiekimoData($sandelioPasiekimoData)
    {
        $this->sandelioPasiekimoData = $sandelioPasiekimoData;

        return $this;
    }

    /**
     * Get sandelioPasiekimoData
     *
     * @return \DateTime
     */
    public function getSandelioPasiekimoData()
    {
        return $this->sandelioPasiekimoData;
    }

    /**
     * Set sandelioPalikimoData
     *
     * @param \DateTime $sandelioPalikimoData
     *
     * @return Siuntinys
     */
    public function setSandelioPalikimoData($sandelioPalikimoData)
    {
        $this->sandelioPalikimoData = $sandelioPalikimoData;

        return $this;
    }

    /**
     * Get sandelioPalikimoData
     *
     * @return \DateTime
     */
    public function getSandelioPalikimoData()
    {
        return $this->sandelioPalikimoData;
    }

    /**
     * Set yraSandelyje
     *
     * @param boolean $yraSandelyje
     *
     * @return Siuntinys
     */
    public function setYraSandelyje($yraSandelyje)
    {
        $this->yraSandelyje = $yraSandelyje;

        return $this;
    }

    /**
     * Get yraSandelyje
     *
     * @return bool
     */
    public function getYraSandelyje()
    {
        return $this->yraSandelyje;
    }

    /**
     * Set uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     *
     * @return Siuntinys
     */
    public function setUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas = null)
    {
        $this->uzsakymas = $uzsakymas;
        return $this;
    }
    /**
     * Get uzsakymas
     *
     * @return \AppBundle\Entity\uzsakymas
     */
    public function getUzsakymas()
    {
        return $this->uzsakymas;
    }
}


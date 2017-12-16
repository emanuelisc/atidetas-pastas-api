<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Apmokejimas
 *
 * @ORM\Table(name="apmokejimas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApmokejimasRepository")
 */
class Apmokejimas
{

    /**
     * @ORM\ManyToOne(targetEntity="pervedimo_tipas", inversedBy="apmokejimai")
     * @ORM\JoinColumn(name="pervedimo_tipas", referencedColumnName="id")
     */
    private $pervedimo_tipas;

    /**
     * @ORM\OneToOne(targetEntity="Uzsakymas", mappedBy="apmokejimas")
     */
    protected $uzsakymas;

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
     * @ORM\Column(name="suma", type="float")
     */
    private $suma;

    /**
     * @var bool
     *
     * @ORM\Column(name="ar_patvirtintas", type="boolean")
     */
    private $arPatvirtintas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="apmokejimo_data", type="datetime")
     */
    private $apmokejimoData;


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
     * Set suma
     *
     * @param float $suma
     *
     * @return Apmokejimas
     */
    public function setSuma($suma)
    {
        $this->suma = $suma;

        return $this;
    }

    /**
     * Get suma
     *
     * @return float
     */
    public function getSuma()
    {
        return $this->suma;
    }

    /**
     * Set arPatvirtintas
     *
     * @param boolean $arPatvirtintas
     *
     * @return Apmokejimas
     */
    public function setArPatvirtintas($arPatvirtintas)
    {
        $this->arPatvirtintas = $arPatvirtintas;

        return $this;
    }

    /**
     * Get arPatvirtintas
     *
     * @return bool
     */
    public function getArPatvirtintas()
    {
        return $this->arPatvirtintas;
    }

    /**
     * Set apmokejimoData
     *
     * @param \DateTime $apmokejimoData
     *
     * @return Apmokejimas
     */
    public function setApmokejimoData($apmokejimoData)
    {
        $this->apmokejimoData = $apmokejimoData;

        return $this;
    }

    /**
     * Get apmokejimoData
     *
     * @return \DateTime
     */
    public function getApmokejimoData()
    {
        return $this->apmokejimoData;
    }

    /**
     * Set uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     *
     * @return Apmokejimas
     */
    public function setUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas = null)
    {
        $this->uzsakymas = $uzsakymas;
        return $this;
    }
    /**
     * Get uzsakymas
     *
     * @return \AppBundle\Entity\Uzsakymas
     */
    public function getUzsakymas()
    {
        return $this->uzsakymas;
    }

    /**
     * Set pervedimo_tipas
     *
     * @param \AppBundle\Entity\pervedimo_tipas $pervedimo_tipas
     *
     * @return Apmokejimas
     */
    public function setPervedimoTipas(\AppBundle\Entity\pervedimo_tipas $pervedimo_tipas = null)
    {
        $this->pervedimo_tipas = $pervedimo_tipas;
        return $this;
    }
    /**
     * Get pervedimo_tipas
     *
     * @return \AppBundle\Entity\pervedimo_tipas
     */
    public function getPervedimoTipas()
    {
        return $this->pervedimo_tipas;
    }
}


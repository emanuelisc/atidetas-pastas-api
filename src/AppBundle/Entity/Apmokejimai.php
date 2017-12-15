<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apmokejimai
 *
 * @ORM\Table(name="apmokejimai")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApmokejimaiRepository")
 */
class Apmokejimai
{
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
     * @return Apmokejimai
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
     * @return Apmokejimai
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
     * @return Apmokejimai
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
}


<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uzsakymai
 *
 * @ORM\Table(name="uzsakymai")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UzsakymaiRepository")
 */
class Uzsakymai
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
     * @ORM\Column(name="gavimo_data", type="date")
     */
    private $gavimoData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uzsakymo_data", type="datetime")
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
     * @return Uzsakymai
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
     * @return Uzsakymai
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
     * @return Uzsakymai
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
     * @return Uzsakymai
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
}


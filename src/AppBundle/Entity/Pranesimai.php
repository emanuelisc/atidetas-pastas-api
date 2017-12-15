<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pranesimai
 *
 * @ORM\Table(name="pranesimai")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PranesimaiRepository")
 */
class Pranesimai
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
     * @ORM\Column(name="tekstas", type="text")
     */
    private $tekstas;

    /**
     * @var string
     *
     * @ORM\Column(name="pavadinimas", type="string", length=255)
     */
    private $pavadinimas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;


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
     * Set tekstas
     *
     * @param string $tekstas
     *
     * @return Pranesimai
     */
    public function setTekstas($tekstas)
    {
        $this->tekstas = $tekstas;

        return $this;
    }

    /**
     * Get tekstas
     *
     * @return string
     */
    public function getTekstas()
    {
        return $this->tekstas;
    }

    /**
     * Set pavadinimas
     *
     * @param string $pavadinimas
     *
     * @return Pranesimai
     */
    public function setPavadinimas($pavadinimas)
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    /**
     * Get pavadinimas
     *
     * @return string
     */
    public function getPavadinimas()
    {
        return $this->pavadinimas;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Pranesimai
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }
}


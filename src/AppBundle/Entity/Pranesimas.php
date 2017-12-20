<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Pranesimas
 *
 * @ORM\Table(name="pranesimas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PranesimasRepository")
 */
class Pranesimas
{

    /**
     * @ORM\OneToMany(targetEntity="pran_vart", mappedBy="pranesimas", cascade={"remove"})
     */
    private $pran_varts;

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
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=255)
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
     * @return Pranesimas
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
     * @return Pranesimas
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
     * @return Pranesimas
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

    public function __construct()
    {
        $this->pran_varts = new ArrayCollection();
    }
    /**
     * Add pran_vart
     *
     * @param \AppBundle\Entity\pran_vart $pran_vart
     *
     * @return Role
     */
    public function addPran_vart(\AppBundle\Entity\pran_vart $pran_vart)
    {
        $this->pran_varts[] = $pran_vart;
        return $this;
    }
    /**
     * Remove pran_vart
     *
     * @param \AppBundle\Entity\pran_vart $pran_vart
     */
    public function removePran_vart(\AppBundle\Entity\pran_vart $pran_vart)
    {
        $this->pran_varts->removeElement($pran_vart);
    }
    /**
     * Get pranvarts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPran_varts()
    {
        return $this->pran_varts;
    }
}


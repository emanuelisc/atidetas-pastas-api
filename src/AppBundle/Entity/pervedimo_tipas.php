<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * pervedimo_tipas
 *
 * @ORM\Table(name="pervedimo_tipas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\pervedimo_tipasRepository")
 */
class pervedimo_tipas
{
     /**
     * @ORM\OneToMany(targetEntity="Apmokejimas", mappedBy="pervedimo_tipas", cascade={"remove"})
     */
    private $apmokejimai;
    
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
     * @ORM\Column(name="pavadinimas", type="string", length=255)
     */
    private $pavadinimas;


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
     * Set pavadinimas
     *
     * @param string $pavadinimas
     *
     * @return pervedimo_tipas
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


    public function __construct()
    {
        $this->apmokejimai = new ArrayCollection();
    }
    /**
     * Add apmokejimas
     *
     * @param \AppBundle\Entity\Apmokejimas $apmokejimas
     *
     * @return pervedimo_tipas
     */
    public function addApmokejimas(\AppBundle\Entity\Apmokejimas $apmokejimas)
    {
        $this->apmokejimai[] = $apmokejimas;
        return $this;
    }
    /**
     * Remove apmokejimas
     *
     * @param \AppBundle\Entity\Apmokejimas $apmokejimas
     */
    public function removeApmokejimas(\AppBundle\Entity\Apmokejimas $apmokejimas)
    {
        $this->apmokejimai->removeElement($apmokejimas);
    }
    /**
     * Get apmokejimai
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApmokejimai()
    {
        return $this->apmokejimai;
    }
}


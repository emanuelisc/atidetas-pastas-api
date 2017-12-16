<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ataskaitos_tipas
 *
 * @ORM\Table(name="ataskaitos_tipas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ataskaitos_tipasRepository")
 */
class ataskaitos_tipas
{

    /**
     * @ORM\OneToMany(targetEntity="Ataskaita", mappedBy="ataskaitos_tipas", cascade={"remove"})
     */
    private $ataskaitos;
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
     * @return ataskaitos_tipai
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
        $this->ataskaitos = new ArrayCollection();
    }
    /**
     * Add ataskaita
     *
     * @param \AppBundle\Entity\Ataskaita $ataskaita
     *
     * @return ataskaitos_tipai
     */
    public function addAtaskaita(\AppBundle\Entity\Ataskaita $ataskaita)
    {
        $this->ataskaitos[] = $ataskaita;
        return $this;
    }
    /**
     * Remove ataskaita
     *
     * @param \AppBundle\Entity\Ataskaita $ataskaita
     */
    public function removeAtaskaita(\AppBundle\Entity\Ataskaita $ataskaita)
    {
        $this->ataskaitos->removeElement($ataskaita);
    }
    /**
     * Get ataskaitos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtaskaitos()
    {
        return $this->ataskaitos;
    }
}


<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * uzsakymo_busena
 *
 * @ORM\Table(name="uzsakymo_busena")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\uzsakymo_busenaRepository")
 */
class uzsakymo_busena
{

    /**
     * @ORM\OneToMany(targetEntity="Uzsakymas", mappedBy="uzsakymo_busena", cascade={"remove"})
     */
    private $uzsakymai;

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
     * @return uzsakymo_busena
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
        $this->uzsakymai = new ArrayCollection();
    }
    /**
     * Add uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     *
     * @return uzsakymo_busena
     */
    public function addUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas)
    {
        $this->uzsakymai[] = $uzsakymas;
        return $this;
    }
    /**
     * Remove uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     */
    public function removeUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas)
    {
        $this->uzsakymai->removeElement($uzsakymas);
    }
    /**
     * Get uzsakymai
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUzsakymai()
    {
        return $this->uzsakymai;
    }
}


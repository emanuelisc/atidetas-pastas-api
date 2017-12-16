<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Darbas
 *
 * @ORM\Table(name="darbas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DarbasRepository")
 */
class Darbas
{

    /**
     * @ORM\ManyToOne(targetEntity="Uzsakymas", inversedBy="darbai")
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
     * @var string
     *
     * @ORM\Column(name="pavadinimas", type="string", length=255)
     */
    private $pavadinimas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="atlikimo_data", type="datetime")
     */
    private $atlikimoData;


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
     * @return Darbas
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
     * Set atlikimoData
     *
     * @param \DateTime $atlikimoData
     *
     * @return Darbas
     */
    public function setAtlikimoData($atlikimoData)
    {
        $this->atlikimoData = $atlikimoData;

        return $this;
    }

    /**
     * Get atlikimoData
     *
     * @return \DateTime
     */
    public function getAtlikimoData()
    {
        return $this->atlikimoData;
    }

    /**
     * Set uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     *
     * @return Darbas
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
}


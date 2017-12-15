<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Darbai
 *
 * @ORM\Table(name="darbai")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DarbaiRepository")
 */
class Darbai
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
     * @return Darbai
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
     * @return Darbai
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
}


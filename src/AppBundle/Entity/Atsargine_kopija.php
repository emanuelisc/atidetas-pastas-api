<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Atsargine_kopija
 *
 * @ORM\Table(name="atsargine_kopija")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Atsargine_kopijaRepository")
 */
class Atsargine_kopija
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="vieta", type="string", length=255)
     */
    private $vieta;


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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Atsargine_kopija
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

    /**
     * Set vieta
     *
     * @param string $vieta
     *
     * @return Atsargine_kopija
     */
    public function setVieta($vieta)
    {
        $this->vieta = $vieta;

        return $this;
    }

    /**
     * Get vieta
     *
     * @return string
     */
    public function getVieta()
    {
        return $this->vieta;
    }
}


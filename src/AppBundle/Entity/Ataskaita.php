<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ataskaita
 *
 * @ORM\Table(name="ataskaita")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AtaskaitaRepository")
 */
class Ataskaita
{

    /**
     * @ORM\ManyToOne(targetEntity="ataskaitos_tipas", inversedBy="ataskaitos")
     * @ORM\JoinColumn(name="tipas", referencedColumnName="id")
     */
    private $ataskaitos_tipas;
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="laikotarpis_nuo", type="date")
     */
    private $laikotarpisNuo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="laikotarpis_iki", type="date")
     */
    private $laikotarpisIki;


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
     * @return Ataskaita
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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Ataskaita
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
     * Set laikotarpisNuo
     *
     * @param \DateTime $laikotarpisNuo
     *
     * @return Ataskaita
     */
    public function setLaikotarpisNuo($laikotarpisNuo)
    {
        $this->laikotarpisNuo = $laikotarpisNuo;

        return $this;
    }

    /**
     * Get laikotarpisNuo
     *
     * @return \DateTime
     */
    public function getLaikotarpisNuo()
    {
        return $this->laikotarpisNuo;
    }

    /**
     * Set laikotarpisIki
     *
     * @param \DateTime $laikotarpisIki
     *
     * @return Ataskaita
     */
    public function setLaikotarpisIki($laikotarpisIki)
    {
        $this->laikotarpisIki = $laikotarpisIki;

        return $this;
    }

    /**
     * Get laikotarpisIki
     *
     * @return \DateTime
     */
    public function getLaikotarpisIki()
    {
        return $this->laikotarpisIki;
    }

    /**
     * Set ataskaitos_tipas
     *
     * @param \AppBundle\Entity\ataskaitos_tipai $ataskaitos_tipas
     *
     * @return Ataskaita
     */
    public function setAtaskaitosTipas(\AppBundle\Entity\ataskaitos_tipas $ataskaitos_tipas = null)
    {
        $this->ataskaitos_tipas = $ataskaitos_tipas;
        return $this;
    }
    /**
     * Get ataskaitos_tipas
     *
     * @return \AppBundle\Entity\ataskaitos_tipas
     */
    public function getAtaskaitosTipas()
    {
        return $this->ataskaitos_tipas;
    }
}


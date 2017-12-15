<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ataskaitos
 *
 * @ORM\Table(name="ataskaitos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AtaskaitosRepository")
 */
class Ataskaitos
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
     * @return Ataskaitos
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
     * @return Ataskaitos
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
     * @return Ataskaitos
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
     * @return Ataskaitos
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
}


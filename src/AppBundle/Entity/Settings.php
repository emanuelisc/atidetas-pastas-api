<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SettingsRepository")
 */
class Settings
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
     * @ORM\Column(name="carrier_price", type="string", length=255)
     */
    private $carrierPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="margin", type="string", length=255)
     */
    private $margin;

    /**
     * @var string
     *
     * @ORM\Column(name="warehousing_price", type="string", length=255)
     */
    private $warehousingPrice;


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
     * Set carrierPrice
     *
     * @param string $carrierPrice
     *
     * @return Settings
     */
    public function setCarrierPrice($carrierPrice)
    {
        $this->carrierPrice = $carrierPrice;

        return $this;
    }

    /**
     * Get carrierPrice
     *
     * @return string
     */
    public function getCarrierPrice()
    {
        return $this->carrierPrice;
    }

    /**
     * Set margin
     *
     * @param string $margin
     *
     * @return Settings
     */
    public function setMargin($margin)
    {
        $this->margin = $margin;

        return $this;
    }

    /**
     * Get margin
     *
     * @return string
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * Set warehousingPrice
     *
     * @param string $warehousingPrice
     *
     * @return Settings
     */
    public function setWarehousingPrice($warehousingPrice)
    {
        $this->warehousingPrice = $warehousingPrice;

        return $this;
    }

    /**
     * Get warehousingPrice
     *
     * @return string
     */
    public function getWarehousingPrice()
    {
        return $this->warehousingPrice;
    }
}


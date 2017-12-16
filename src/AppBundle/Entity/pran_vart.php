<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * pran_vart
 *
 * @ORM\Table(name="pran_vart")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\pran_vartRepository")
 */
class pran_vart
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="pran_varts")
     * @ORM\JoinColumn(name="vartotojo_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pranesimas", inversedBy="pran_varts")
     * @ORM\JoinColumn(name="pranesimas_id", referencedColumnName="id")
    */
    private $pranesimas;


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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return pran_vart
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set pranesimas
     *
     * @param \AppBundle\Entity\Pranesimas $pranesimas
     *
     * @return pran_vart
     */
    public function setPranesimas(\AppBundle\Entity\Pranesimas $pranesimas = null)
    {
        $this->pranesimas = $pranesimas;
        return $this;
    }
    /**
     * Get pranesimas
     *
     * @return \AppBundle\Entity\Pranesimas
     */
    public function getPranesimas()
    {
        return $this->pranesimas;
    }
}


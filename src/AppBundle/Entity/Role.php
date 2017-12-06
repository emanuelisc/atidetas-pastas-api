<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\OneToMany(targetEntity="vart_role", mappedBy="role", cascade={"remove"})
     */
    private $vart_roles;
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
     * @ORM\Column(name="pavadinimas", type="string", length=20)
     */
    private $pavadinimas;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=20)
     */
    private $slug;


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
     * @return Role
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Role
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function __construct()
    {
        $this->vart_roles = new ArrayCollection();
    }
    /**
     * Add vart_role
     *
     * @param \AppBundle\Entity\vart_role $vart_role
     *
     * @return Role
     */
    public function addVart_role(\AppBundle\Entity\vart_role $vart_role)
    {
        $this->vart_roles[] = $vart_role;
        return $this;
    }
    /**
     * Remove vart_role
     *
     * @param \AppBundle\Entity\vart_role $vart_role
     */
    public function removeVart_role(\AppBundle\Entity\vart_role $vart_role)
    {
        $this->vart_roles->removeElement($vart_role);
    }
    /**
     * Get vart_roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVart_roles()
    {
        return $this->vart_roles;
    }
}


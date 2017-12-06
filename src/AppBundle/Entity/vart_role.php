<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * vart_role
 *
 * @ORM\Table(name="vart_role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\vart_roleRepository")
 */
class vart_role
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="vart_roles")
     * @ORM\JoinColumn(name="vartotojo_id", referencedColumnName="id")
     */
    private $vartotojoId;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="vart_roles")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id")
     */
    private $rolesId;


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
     * Set vartotojoId
     *
     * @param integer $vartotojoId
     *
     * @return vart_role
     */
    public function setVartotojoId($vartotojoId)
    {
        $this->vartotojoId = $vartotojoId;

        return $this;
    }

    /**
     * Get vartotojoId
     *
     * @return int
     */
    public function getVartotojoId()
    {
        return $this->vartotojoId;
    }

    /**
     * Set rolesId
     *
     * @param integer $rolesId
     *
     * @return vart_role
     */
    public function setRolesId($rolesId)
    {
        $this->rolesId = $rolesId;

        return $this;
    }

    /**
     * Get rolesId
     *
     * @return int
     */
    public function getRolesId()
    {
        return $this->rolesId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return vart_role
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
        return $this->User;
    }

    /**
     * Set role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return vart_role
     */
    public function setRole(\AppBundle\Entity\Role $role = null)
    {
        $this->role = $role;
        return $this;
    }
    /**
     * Get role
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}


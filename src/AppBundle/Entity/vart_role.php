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
    private $user;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="vart_roles")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id")
     */
    private $role;


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
        return $this->user;
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


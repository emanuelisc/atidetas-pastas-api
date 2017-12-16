<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\OneToMany(targetEntity="pran_vart", mappedBy="user", cascade={"remove"})
     */
    private $pran_varts;

    /**
     * @ORM\OneToMany(targetEntity="vart_role", mappedBy="user", cascade={"remove"})
     */
    private $vart_roles;

    /**
     * @ORM\OneToMany(targetEntity="Uzsakymas", mappedBy="user", cascade={"remove"})
     */
    private $uzsakymai;

    /**
     * @ORM\ManyToOne(targetEntity="Miestas", inversedBy="users")
     * @ORM\JoinColumn(name="miestas_id", referencedColumnName="id")
     */
    private $miestas;
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
     * @ORM\Column(name="vardas", type="string", length=255)
     */
    private $vardas;

    /**
     * @var string
     *
     * @ORM\Column(name="pavarde", type="string", length=255)
     */
    private $pavarde;

    /**
     * @var string
     *
     * @ORM\Column(name="registracijos_data", type="string", length=255, nullable=true))
     */
    private $registracijosData;


    /**
     * @var string
     *
     * @ORM\Column(name="adresas", type="string", length=255, nullable=true)
     */
    private $adresas;

    /**
     * @var string
     *
     * @ORM\Column(name="pastas", type="string", length=255)
     */
    private $pastas;

    /**
     * @var string
     *
     * @ORM\Column(name="slaptazodis", type="string", length=255)
     */
    private $slaptazodis;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;


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
     * Set vardas
     *
     * @param string $vardas
     *
     * @return User
     */
    public function setVardas($vardas)
    {
        $this->vardas = $vardas;

        return $this;
    }

    /**
     * Get vardas
     *
     * @return string
     */
    public function getVardas()
    {
        return $this->vardas;
    }

    /**
     * Set pavarde
     *
     * @param string $pavarde
     *
     * @return User
     */
    public function setPavarde($pavarde)
    {
        $this->pavarde = $pavarde;

        return $this;
    }

    /**
     * Get pavarde
     *
     * @return string
     */
    public function getPavarde()
    {
        return $this->pavarde;
    }

    /**
     * Set registracijosData
     *
     * @param string $registracijosData
     *
     * @return User
     */
    public function setRegistracijosData($registracijosData)
    {
        $this->registracijosData = $registracijosData;

        return $this;
    }

    /**
     * Get registracijosData
     *
     * @return string
     */
    public function getRegistracijosData()
    {
        return $this->registracijosData;
    }

    /**
     * Set adresas
     *
     * @param string $adresas
     *
     * @return User
     */
    public function setAdresas($adresas)
    {
        $this->adresas = $adresas;

        return $this;
    }

    /**
     * Get adresas
     *
     * @return string
     */
    public function getAdresas()
    {
        return $this->adresas;
    }

    /**
     * Set pastas
     *
     * @param string $pastas
     *
     * @return User
     */
    public function setPastas($pastas)
    {
        $this->pastas = $pastas;

        return $this;
    }

    /**
     * Get pastas
     *
     * @return string
     */
    public function getPastas()
    {
        return $this->pastas;
    }

        /**
     * Set slaptazodis
     *
     * @param string $slaptazodis
     *
     * @return User
     */
    public function setSlaptazodis($slaptazodis)
    {
        $this->slaptazodis = $slaptazodis;

        return $this;
    }

    /**
     * Get slaptazodis
     *
     * @return string
     */
    public function getSlaptazodis()
    {
        return $this->slaptazodis;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

     /**
     * Set miestas
     *
     * @param \AppBundle\Entity\Miestas $miestas
     *
     * @return User
     */
    public function setMiestas(\AppBundle\Entity\Miestas $miestas = null)
    {
        $this->miestas = $miestas;
        return $this;
    }
    /**
     * Get miestas
     *
     * @return \AppBundle\Entity\Miestas
     */
    public function getMiestas()
    {
        return $this->miestas;
    }

    public function __construct()
    {
        $this->vart_roles = new ArrayCollection();
        $this->uzsakymai = new ArrayCollection();
        $this->pran_varts = new ArrayCollection();
    }
    /**
     * Add vart_role
     *
     * @param \AppBundle\Entity\vart_role $vart_role
     *
     * @return User
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

    /**
     * Add pran_vart
     *
     * @param \AppBundle\Entity\pran_vart $pran_vart
     *
     * @return User
     */
    public function addPran_vart(\AppBundle\Entity\pran_vart $pran_vart)
    {
        $this->pran_varts[] = $pran_vart;
        return $this;
    }
    /**
     * Remove pran_vart
     *
     * @param \AppBundle\Entity\pran_vart $pran_vart
     */
    public function removePran_vart(\AppBundle\Entity\pran_vart $pran_vart)
    {
        $this->pran_varts->removeElement($pran_vart);
    }
    /**
     * Get pran_varts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPran_varts()
    {
        return $this->pran_varts;
    }

    /**
     * Add uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     *
     * @return User
     */
    public function addUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas)
    {
        $this->uzsakymai[] = $uzsakymas;
        return $this;
    }
    /**
     * Remove uzsakymas
     *
     * @param \AppBundle\Entity\Uzsakymas $uzsakymas
     */
    public function removeUzsakymas(\AppBundle\Entity\Uzsakymas $uzsakymas)
    {
        $this->uzsakymai->removeElement($uzsakymas);
    }
    /**
     * Get uzsakymai
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUzsakymai()
    {
        return $this->uzsakymai;
    }
}


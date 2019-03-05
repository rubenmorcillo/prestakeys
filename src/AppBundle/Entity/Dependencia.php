<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DependenciaRepository")
 * @ORM\Table(name="dependencia")
 */
class Dependencia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario")
     * @ORM\JoinTable(name="responsable")
     * @var Usuario[]
     */
    private $responsables;

    public function __construct()
    {
        // Recordatorio: las colecciones hay que inicializarlas en el constructor
        $this->responsables = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Dependencia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return Usuario[]
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
     * @param Usuario[] $responsables
     * @return Dependencia
     */
    public function setResponsables($responsables)
    {
        $this->responsables = $responsables;
        return $this;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="llave")
 */
class Llave
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
    private $descripcion;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $codigo;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime
     */
    private $fechaPrestamo;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="llavesPrestadas")
     * @ORM\JoinColumn(nullable=true)
     * @var Usuario
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Dependencia")
     * @ORM\JoinColumn(nullable=false)
     * @var Dependencia
     */
    private $dependencia;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Llave
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     * @return Llave
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaPrestamo()
    {
        return $this->fechaPrestamo;
    }

    /**
     * @param \DateTime|null $fechaPrestamo
     * @return Llave
     */
    public function setFechaPrestamo(\DateTime $fechaPrestamo = null)
    {
        $this->fechaPrestamo = $fechaPrestamo;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|null $usuario
     * @return Llave
     */
    public function setUsuario(Usuario $usuario = null)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return Dependencia
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * @param Dependencia $dependencia
     * @return Llave
     */
    public function setDependencia(Dependencia $dependencia)
    {
        $this->dependencia = $dependencia;
        return $this;
    }
}

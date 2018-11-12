<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="historia")
 */
class Historia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Llave")
     * @var Llave
     */
    private $llave;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @var Usuario
     */
    private $usuario;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @var \DateTime
     */
    private $fechaPrestamo;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @var \DateTime
     */
    private $fechaDevolucion;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Llave
     */
    public function getLlave()
    {
        return $this->llave;
    }

    /**
     * @param Llave $llave
     * @return Historia
     */
    public function setLlave(Llave $llave)
    {
        $this->llave = $llave;
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
     * @param Usuario $usuario
     * @return Historia
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
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
     * @param \DateTime $fechaPrestamo
     * @return Historia
     */
    public function setFechaPrestamo(\DateTime $fechaPrestamo)
    {
        $this->fechaPrestamo = $fechaPrestamo;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * @param \DateTime $fechaDevolucion
     * @return Historia
     */
    public function setFechaDevolucion(\DateTime $fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;
        return $this;
    }
}

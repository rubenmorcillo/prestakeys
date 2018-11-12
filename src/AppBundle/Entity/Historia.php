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
}

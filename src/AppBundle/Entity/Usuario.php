<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario
{
    private $id;

    private $nombre;

    private $apellidos;

    private $ordenanza;

    private $secretario;
}

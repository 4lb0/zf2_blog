<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 

/** @ORM\Entity */
class Usuario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */ 
    protected $id;
    /** @ORM\Column */
    protected $email;
    /** @ORM\Column */
    protected $contrasena;
    /** @ORM\Column */
    protected $nombre;
    /** @ORM\Column(type="boolean") */
    protected $activo;
    /** @ORM\Column(type="datetime") */
    protected $fechaAlta;
}

<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 

/** @ORM\Entity */
class Imagen 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */ 
    protected $id;
    /** @ORM\Column */
    protected $archivo;
    /** @ORM\Column */
    protected $descripcion;
    /**
     * @ORM\ManyToOne(targetEntity="Entrada", inversedBy="imagenes")
     * @ORM\JoinColumn(name="entrada_id", referencedColumnName="id")
     **/
    protected $entrada;
}


<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 

/** @ORM\Entity */
class Categoria 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */ 
    protected $id;
    /** @ORM\Column */
    protected $nombre;
    /**
     * @ORM\OneToMany(targetEntity="Entrada", mappedBy="categoria")
     **/
    protected $entradas;
}


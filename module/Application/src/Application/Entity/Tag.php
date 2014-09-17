<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 

/** @ORM\Entity */
class Tag 
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
     * @ORM\ManyToMany(targetEntity="Entrada", mappedBy="tags")
     **/
    protected $entradas;
}

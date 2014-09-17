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

    public function __construct()
    {
        $this->entradas = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add entradas
     *
     * @param \Application\Entity\Entrada $entradas
     * @return Categoria
     */
    public function addEntrada(\Application\Entity\Entrada $entradas)
    {
        $this->entradas[] = $entradas;

        return $this;
    }

    /**
     * Remove entradas
     *
     * @param \Application\Entity\Entrada $entradas
     */
    public function removeEntrada(\Application\Entity\Entrada $entradas)
    {
        $this->entradas->removeElement($entradas);
    }

    /**
     * Get entradas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntradas()
    {
        return $this->entradas;
    }
}

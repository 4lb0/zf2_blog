<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 
use Doctrine\Common\Collections\ArrayCollection;

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
     * Set archivo
     *
     * @param string $archivo
     * @return Imagen
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Imagen
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set entrada
     *
     * @param \Application\Entity\Entrada $entrada
     * @return Imagen
     */
    public function setEntrada(\Application\Entity\Entrada $entrada = null)
    {
        $this->entrada = $entrada;

        return $this;
    }

    /**
     * Get entrada
     *
     * @return \Application\Entity\Entrada 
     */
    public function getEntrada()
    {
        return $this->entrada;
    }
}

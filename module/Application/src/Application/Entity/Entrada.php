<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 

/** @ORM\Entity */
class Entrada
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */ 
    protected $id;
    /** @ORM\Column */
    protected $titulo;
    /** @ORM\Column */
    protected $contenido;
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="entradas")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     **/
    protected $categoria;
    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="entradas")
     * @ORM\JoinTable(name="entradas_tags")
     **/
    protected $tags;    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="entradas")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    protected $autor;
    /**
     * @ORM\OneToMany(targetEntity="Imagen", mappedBy="entrada")
     **/
    protected $imagenes;
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
     * Set titulo
     *
     * @param string $titulo
     * @return Entrada
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Entrada
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    public function getResumen()
    {
        return wordwrap($this->getContenido(), 200, '...', true);
    }
}

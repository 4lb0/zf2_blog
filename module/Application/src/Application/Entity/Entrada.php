<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM; 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="entradas",cascade={"persist"})
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

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->imagenes = new ArrayCollection();
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

    /**
     * Set categoria
     *
     * @param \Application\Entity\Categoria $categoria
     * @return Entrada
     */
    public function setCategoria(\Application\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Application\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add tags
     *
     * @param \Application\Entity\Tag $tags
     * @return Entrada
     */
    public function addTag(\Application\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Application\Entity\Tag $tags
     */
    public function removeTag(\Application\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * @param Collection $tags
     */
    public function addTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->addEntrada($this);
            $this->tags->add($tag);
        }
    }

    /**
     * @param Collection $tags
     */
    public function removeTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->removeEntrada($this);
            $this->tags->removeElement($tag);
        }
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set autor
     *
     * @param \Application\Entity\Usuario $autor
     * @return Entrada
     */
    public function setAutor(\Application\Entity\Usuario $autor = null)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return \Application\Entity\Usuario 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Add imagenes
     *
     * @param \Application\Entity\Imagen $imagenes
     * @return Entrada
     */
    public function addImagene(\Application\Entity\Imagen $imagenes)
    {
        $this->imagenes[] = $imagenes;

        return $this;
    }

    /**
     * Remove imagenes
     *
     * @param \Application\Entity\Imagen $imagenes
     */
    public function removeImagene(\Application\Entity\Imagen $imagenes)
    {
        $this->imagenes->removeElement($imagenes);
    }

    /**
     * Get imagenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }
}

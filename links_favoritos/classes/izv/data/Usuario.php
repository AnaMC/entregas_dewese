<?php

namespace izv\data;
/**
 * @Entity @Table(name="usuario")
 * 
 * id, correo, alias, nombre, clave, activo, fechaalta, administrador
 */
class Usuario {

    use \izv\common\Common;
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=30, nullable=true, unique=true)
     */
    private $alias;
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $clave;
    
    /**
     * @Column(type="string", length=30, nullable=false)
     */
    private $nombre;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     */
    private $correo;
    
    /**
     * @Column(type="date", nullable=false)
     */
    private $fechaalta;
    
    /**
     * @Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $activo = 0;
    
    /**
     * @Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $rol = 0;
    
    /** 
     * @OneToMany(targetEntity="Link", mappedBy="usuario") 
     */
    private $links;
    
    /** 
     * @OneToMany(targetEntity="Categoria", mappedBy="usuario") 
     */
    private $categorias;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
        //Como no puede ser null y el Datetime no tiene formato autogenerado en mysql creamos una instancia
        $this->fechaalta = new \DateTime();
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Usuario
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Usuario
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
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
     * Set correo
     *
     * @param string $correo
     *
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set fechaalta
     *
     * @param \DateTime $fechaalta
     *
     * @return Usuario
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return \DateTime
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set rol
     *
     * @param boolean $rol
     *
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return boolean
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Add link
     *
     * @param \Link $link
     *
     * @return Usuario
     */
    public function addLink(Link $link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * Remove link
     *
     * @param \Link $link
     */
    public function removeLink(Link $link)
    {
        $this->links->removeElement($link);
    }

    /**
     * Get links
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Add categoria
     *
     * @param \Categoria $categoria
     *
     * @return Usuario
     */
    public function addCategoria(Categoria $categoria)
    {
        $this->categorias[] = $categoria;

        return $this;
    }

    /**
     * Remove categoria
     *
     * @param \Categoria $categoria
     */
    public function removeCategoria(Categoria $categoria)
    {
        $this->categorias->removeElement($categoria);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorias()
    {
        return $this->categorias;
    }
}

<?php

namespace izv\data;

/** @Entity @Table(name="articulo") */

class Articulo {
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;
    
    /** @Column(type="string", length=250, unique=false, nullable=false) */
    private $nombre;
    
    /**
       * @Column(type="decimal", nullable=false, precision=7, scale=2) 
       */
    private $precio;
    
    /** @Column(type="integer", precision=3, nullable=true) */
    private $cantidad;
    
    /** @Column(type="string", length=50, unique=false, nullable=false) */
    private $tallaDesde;
    
    /** @Column(type="string", length=50, unique=false, nullable=false) */
    private $tallaHasta;
    
     /** @Column(type="string", length=250, unique=false, nullable=true)*/
    private $descripcion;
  
    /** @Column(type="string", length=250, unique=false, nullable=false) */
    private $tipo;
    
    /** @OneToMany(targetEntity="Detalle", mappedBy="articulo") */
    private $detalles;
    
    /** @OneToMany(targetEntity="Favorito", mappedBy="articulo") */
    private $favoritos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favoritos = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Articulo
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
     * Set precio
     *
     * @param string $precio
     *
     * @return Articulo
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Articulo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set tallaDesde
     *
     * @param string $tallaDesde
     *
     * @return Articulo
     */
    public function setTallaDesde($tallaDesde)
    {
        $this->tallaDesde = $tallaDesde;

        return $this;
    }

    /**
     * Get tallaDesde
     *
     * @return string
     */
    public function getTallaDesde()
    {
        return $this->tallaDesde;
    }

    /**
     * Set tallaHasta
     *
     * @param string $tallaHasta
     *
     * @return Articulo
     */
    public function setTallaHasta($tallaHasta)
    {
        $this->tallaHasta = $tallaHasta;

        return $this;
    }

    /**
     * Get tallaHasta
     *
     * @return string
     */
    public function getTallaHasta()
    {
        return $this->tallaHasta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Articulo
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Articulo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add detalle
     *
     * @param \izv\data\Detalle $detalle
     *
     * @return Articulo
     */
    public function addDetalle(\izv\data\Detalle $detalle)
    {
        $this->detalles[] = $detalle;

        return $this;
    }

    /**
     * Remove detalle
     *
     * @param \izv\data\Detalle $detalle
     */
    public function removeDetalle(\izv\data\Detalle $detalle)
    {
        $this->detalles->removeElement($detalle);
    }

    /**
     * Get detalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Add favorito
     *
     * @param \izv\data\Favorito $favorito
     *
     * @return Articulo
     */
    public function addFavorito(\izv\data\Favorito $favorito)
    {
        $this->favoritos[] = $favorito;

        return $this;
    }

    /**
     * Remove favorito
     *
     * @param \izv\data\Favorito $favorito
     */
    public function removeFavorito(\izv\data\Favorito $favorito)
    {
        $this->favoritos->removeElement($favorito);
    }

    /**
     * Get favoritos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoritos()
    {
        return $this->favoritos;
    }
}


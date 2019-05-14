<?php

namespace izv\data;

/** @Entity @Table(name="usuario") */

class Usuario {
      /** @Id @Column(type="integer") @GeneratedValue */
      private $id;
      
      /** @Column(type="string", length=250, unique=false, nullable=false) */
      private $nombre;
      
      /** @Column(type="string", length=250, unique=false, nullable=false) */
      private $apellidos;
      
      /** @Column(type="string", length=250, unique=false, nullable=false)*/
      private $alias;
      
      /** @Column(type="string", length=20, unique=false, nullable=false)*/
      private $clave;
      
      /** @Column(type="string", length=250, unique=true, nullable=false) */
      private $correo;
      
      /** @Column(type="integer", precision=1, unique=false, nullable=false) */
      private $activo;
      
      /** @Column(type="integer", precision=1, unique=false, nullable=false) */
      private $tipo;
      
      /** @OneToMany(targetEntity="Favorito", mappedBy="usuario") */
      private $favoritos;
      
      /** @OneToMany(targetEntity="Pedido", mappedBy="usuario") */
      private $pedidos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favoritos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pedidos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
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
     * Set activo
     *
     * @param integer $activo
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
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Usuario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add favorito
     *
     * @param \izv\data\Favorito $favorito
     *
     * @return Usuario
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

    /**
     * Add pedido
     *
     * @param \izv\data\Pedido $pedido
     *
     * @return Usuario
     */
    public function addPedido(\izv\data\Pedido $pedido)
    {
        $this->pedidos[] = $pedido;

        return $this;
    }

    /**
     * Remove pedido
     *
     * @param \izv\data\Pedido $pedido
     */
    public function removePedido(\izv\data\Pedido $pedido)
    {
        $this->pedidos->removeElement($pedido);
    }

    /**
     * Get pedidos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }
}


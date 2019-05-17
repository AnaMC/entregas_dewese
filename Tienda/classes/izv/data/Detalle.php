<?php

namespace izv\data;

/** @Entity @Table(name="detalle") */

class Detalle {
        
    use \izv\common\Common;
    
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;
    
    /** @Column(type="decimal", nullable=false, precision=7, scale=2) */
    private $precio;
    
    /** @Column(type="integer", precision=3, nullable=false) */
    private $cantidad;
    
    /**
    * @ManyToOne(targetEntity="Pedido", inversedBy="detalles")
    * @JoinColumn(name="idPedido", referencedColumnName="id", nullable=false)
    */
    private $pedido;
    
    /**
    * @ManyToOne(targetEntity="Articulo", inversedBy="detalles")
    * @JoinColumn(name="idArticulo", referencedColumnName="id", nullable=false)
    */
    
    private $articulo;

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
     * Set precio
     *
     * @param string $precio
     *
     * @return Detalle
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
     * @return Detalle
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
     * Set pedido
     *
     * @param \izv\data\Pedido $pedido
     *
     * @return Detalle
     */
    public function setPedido(\izv\data\Pedido $pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \izv\data\Pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set articulo
     *
     * @param \izv\data\Articulo $articulo
     *
     * @return Detalle
     */
    public function setArticulo(\izv\data\Articulo $articulo)
    {
        $this->articulo = $articulo;

        return $this;
    }

    /**
     * Get articulo
     *
     * @return \izv\data\Articulo
     */
    public function getArticulo()
    {
        return $this->articulo;
    }
}


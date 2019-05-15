<?php

namespace izv\data;

/** @Entity @Table(name="pedido") */

class Pedido {
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;
 
  /** @Column(type="datetime", unique=false, nullable=false) */
  private $fechaPedido;
  
  /** @Column(type="string", length=250, unique=false, nullable=false) */
  private $formaPago;
  
  /** @OneToMany(targetEntity="Detalle", mappedBy="pedido") */
  private $detalles;
  
  /**
  * @ManyToOne(targetEntity="Usuario", inversedBy="pedidos")
  * @JoinColumn(name="idUsuario", referencedColumnName="id", nullable=false)
  */
  private $usuario;
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechaPedido = new \DateTime();
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
     * Set fechaPedido
     *
     * @param \DateTime $fechaPedido
     *
     * @return Pedido
     */
    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;

        return $this;
    }

    /**
     * Get fechaPedido
     *
     * @return \DateTime
     */
    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    /**
     * Set formaPago
     *
     * @param string $formaPago
     *
     * @return Pedido
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Add detalle
     *
     * @param \izv\data\Detalle $detalle
     *
     * @return Pedido
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
     * Set usuario
     *
     * @param \izv\data\Usuario $usuario
     *
     * @return Pedido
     */
    public function setUsuario(\izv\data\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \izv\data\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}


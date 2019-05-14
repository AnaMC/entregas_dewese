<?php

namespace izv\data;

/** @Entity @Table(name="detalle") */

class Detalle {
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
}

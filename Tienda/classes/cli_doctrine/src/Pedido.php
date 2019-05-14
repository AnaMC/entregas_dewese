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

}

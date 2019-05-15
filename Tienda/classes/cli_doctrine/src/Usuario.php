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
  
  /** @Column(type="string", length=250, unique=false, nullable=false)*/
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
}

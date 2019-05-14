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
}

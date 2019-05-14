<?php

namespace izv\data;

/** @Entity @Table(name="favorito") */

class Favorito {
   /** @Id @Column(type="integer") @GeneratedValue */
   private $id;
   
   /**
    * @Column(type="string", length=255 ,nullable=false)
    */
   private $href;
   
   /**
   * @Column(type="text", nullable=false)
   */
   private $comentario;
    
   /** 
   * @ManyToOne(targetEntity="Usuario", inversedBy="favoritos") 
   * @JoinColum(name="idUsuario", referencedColumnName="id", nullable=false)
   */
   private $usuario ;
   
}

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
     * Set href
     *
     * @param string $href
     *
     * @return Favorito
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Favorito
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set usuario
     *
     * @param \izv\data\Usuario $usuario
     *
     * @return Favorito
     */
    public function setUsuario(\izv\data\Usuario $usuario = null)
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


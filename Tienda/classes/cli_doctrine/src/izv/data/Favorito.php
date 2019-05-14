<?php

namespace izv\data;

/**
 * Favorito
 */
class Favorito
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \izv\data\Usuario
     */
    private $usuario;


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


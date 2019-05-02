<?php
/** @Entity @Table(name="recurso") */

class Recurso {
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;
  /** @Column(type="string", length=250, unique=false, nullable=false) */
  private $nombre;
   /** @Column(type="string", length=250, nullable=false) */
  private $tipo;
  /** @Column(type="integer", length=400, nullable=false) */
  private $cantidad;
   /**@Column(type="string", length=250, unique=false, nullable=true)*/
  private $descripcion;
  
  /** @OneToMany(targetEntity="AulaRecurso", mappedBy="recursos") */
  private $aulasRecursos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aulasRecursos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Recurso
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Recurso
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Recurso
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
     * Add aulasRecurso
     *
     * @param \AulaRecurso $aulasRecurso
     *
     * @return Recurso
     */
    public function addAulasRecurso(\AulaRecurso $aulasRecurso)
    {
        $this->aulasRecursos[] = $aulasRecurso;

        return $this;
    }

    /**
     * Remove aulasRecurso
     *
     * @param \AulaRecurso $aulasRecurso
     */
    public function removeAulasRecurso(\AulaRecurso $aulasRecurso)
    {
        $this->aulasRecursos->removeElement($aulasRecurso);
    }

    /**
     * Get aulasRecursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAulasRecursos()
    {
        return $this->aulasRecursos;
    }
}

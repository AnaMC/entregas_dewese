<?php
/** @Entity @Table(name="aulaRecurso") */

class AulaRecurso {
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;
  
  /**@Column(type="integer", length=3, unique=true, nullable=false)*/
  private $idAula;
  
  /**@Column(type="integer", length=3, unique=true, nullable=false)*/
  private $idRecurso;
  
  /**@Column(type="integer", length=3, unique=false, nullable=true)*/
  private $posicion;
  
  /**
  * @ManyToOne(targetEntity="Aula", inversedBy="aulasRecursos")
  * @JoinColumn(name="idAula", referencedColumnName="id", nullable=false)
  */
  private $aulas;
  
  /**
  * @ManyToOne(targetEntity="Recurso", inversedBy="recursos")
  * @JoinColumn(name="idRecurso", referencedColumnName="id", nullable=false)
  */
  private $recursos;
  

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
     * Set aulas
     *
     * @param \Aula $aulas
     *
     * @return AulaRecurso
     */
    public function setAulas(\Aula $aulas)
    {
        $this->aulas = $aulas;

        return $this;
    }

    /**
     * Get aulas
     *
     * @return \Aula
     */
    public function getAulas()
    {
        return $this->aulas;
    }

    /**
     * Set recursos
     *
     * @param \Recurso $recursos
     *
     * @return AulaRecurso
     */
    public function setRecursos(\Recurso $recursos)
    {
        $this->recursos = $recursos;

        return $this;
    }

    /**
     * Get recursos
     *
     * @return \Recurso
     */
    public function getRecursos()
    {
        return $this->recursos;
    }
}

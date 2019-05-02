<?php
/** @Entity @Table(name="aula") */

class Aula {
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;
  /** @Column(type="string", length=20, unique=true, nullable=false) */
  private $naula;
  /**@Column(type="integer", length=2, unique=false, nullable=false)*/
  private $planta;
  /** @Column(type="integer", length=400, nullable=false) */
  private $aforo;
  /** @Column(type="string", length=250, nullable=false) */
  private $tipo;
  
  /** @OneToMany(targetEntity="AulaRecurso", mappedBy="aulas") */
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
     * Set naula
     *
     * @param string $naula
     *
     * @return Aula
     */
    public function setNaula($naula)
    {
        $this->naula = $naula;

        return $this;
    }

    /**
     * Get naula
     *
     * @return string
     */
    public function getNaula()
    {
        return $this->naula;
    }

    /**
     * Set aforo
     *
     * @param integer $aforo
     *
     * @return Aula
     */
    public function setAforo($aforo)
    {
        $this->aforo = $aforo;

        return $this;
    }

    /**
     * Get aforo
     *
     * @return integer
     */
    public function getAforo()
    {
        return $this->aforo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Aula
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
     * Add aulasRecurso
     *
     * @param \AulaRecurso $aulasRecurso
     *
     * @return Aula
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

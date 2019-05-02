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
}
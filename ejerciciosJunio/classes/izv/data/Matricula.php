<?php

namespace izv\data;

require_once('../classes/izv/comun/MetodosComunes.php');
require_once('../classes/izv/util/Parametros.php');

class Matricula{
    
    use \izv\comun\MetodosComunes;
    
    private $id = 0, $nombre, $apellido, $dni, $fecha, $direccion, $sexo, $asignatura;
    
    //Realmente solo inicializa valores
    }
    function __construct($nombre = null, $apellido = null, $dni = null, $fecha= null, $direccion = null,$sexo = null, $asignatura = null){
        
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha = $fecha;
        $this->direccion = $direccion;
        $this->sexo = $sexo;
        $this->asignatura = $asignatura;
    }
    
    function getNombre($nombre){
        return $this->$nombre;
    }
    
    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
    
    function getApellido($apellido){
        return $this->$apellido;
    }
    
   function getDni($dni){
        return $this->$dni;
    }
    
    function getFecha($fecha){
        return $this->$fecha;
    }
    
    function getDireccion($direccion){
        return $this->$direccion;
    }
    
    function getSexo($sexo){
        return $this->$sexo;
    }
    
    function getAsignatura($asignatura){
        return $this->$asignatura;
    }
    
       function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    function setAtributos(array $atributosValores){
        foreach($this as $nombreAtributo => $valorAtributo){
            $this->$nombreAtributo = $atributosValores[$nombreAtributo];
            
        }
        return $this;
    }

    // static function leer(){
    //     $matricula=new Matricula();
    //     $atributos = $matricula->getAtributos();
    //     foreach($atributos as $indice =>$valor){
    //         $atributos[$indice] = Parametros::leerPost($indice);
    //     }
    //     $matricula->setAtributos($atributos);
    //     return $matricula;
    // }
    
    /*
        $m = new Matricula();
        en los seters  se meten un return this para que devuelva el propio objeto y  poder concatenar asi:
        $m->setNombre('Pepe')->setApellidos('Lopez Perez');
    */
}
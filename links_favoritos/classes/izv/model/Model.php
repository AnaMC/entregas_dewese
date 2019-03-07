<?php

namespace izv\model;

use izv\tools\Bootstrap;
use izv\tools\Util;

class Model {

    private $datosVista = array();
    // Creamos el manejador de la BD (Doctrine)
    private $entityManager;

    function __construct() {
        // Hacemos la instancia en el constructor xq todos los modelos van a necesitar el manejador
        $bootstrap = new Bootstrap();
        
        $this->entityManager = $bootstrap->getEntityManager();
    }
    
    function add(array $array) {
        foreach($array as $indice => $valor) {
            $this->set($indice, $valor);
        }
    }

    function get($name) {
        if(isset($this->datosVista[$name])) {
            return $this->datosVista[$name];
        }
        return null;
    }

    function getViewData() {
        return $this->datosVista;
    }
    
    function getEntityManager(){
        return $this->entityManager;
    }

    function set($name, $value) {
        $this->datosVista[$name] = $value;
        return $this;
    }
}
<?php

namespace izv\comun;

trait MetodosComunes {

    function getAtributos() {
        $atributos = [];
        foreach($this as $nombreAtributo => $valorAtributo) {
            $atributos[$nombreAtributo] = $valorAtributo;
        }
        return $atributos;
    }

    function setAtributos(array $atributosValores) {
        foreach($this as $nombreAtributo => $valorAtributo) {
            $this->$nombreAtributo = $atributosValores[$nombreAtributo];
        }
        return $this;
    }

     function __toString() {
        $todo = '';
        foreach($this as $nombreAtributo => $valorAtributo) {
            $todo .= "$nombreAtributo: $valorAtributo<br>";
        }
        return $todo;
    }
}
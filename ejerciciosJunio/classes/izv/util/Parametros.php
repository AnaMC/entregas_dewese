<?php

//Equivalente a Reader

namespace izv\util;

class Parametros{
  
  // indicamos que el parametro va a ser tipo string
  static function leer(string $nombre) {
        $valor = self::leerGet($nombre);
        if($valor === null) {
            $valor = self::leerPost($nombre);
        }
        return $valor;
    }
  
    static function leerGet(string $nombre){
        return self::_leer($nombre, $_GET);
    }

    static function leerPost(string $nombre) {
        return self::_leer($nombre, $_POST);
    }
    
    /*
    //$nombre -> Nombre del parametro que queremos leer por post
   
      static function leerPost($nombre){
          $valor = null;
           
          if(isset($_POST[$nombre])) {
                $valor = $_POST[$nombre];
            }
            return $valor;
      }
       
       Para poder leerlo en un futuro tendremos que hacer:
       
       $parametros = new Parametros();
       $valor = $parametros->leerPost('nombre');
       
       Sin embargo, si lo hacemos con un static, la forma de usarlo será
       
       $valor = Parametros::leerPost('nombre'),
       
       En esta segunda forma:
        - NO hay que instanciar la clase
       
       ** Si una clase no tiene variables de instancia debería ser estática.
       
       --RESUMEN--
    
       método de instancia
       $parametros = new Parametros();
       $valor = $parametros->leerPost('nombre');
       
       método de clase
       $valor = Parametros::leerPost('nombre');
   */
   
    static private function _leer(string $nombre, array $array){
        $valor = null;
        
        if(isset($array[$nombre])) {
            $valor = trim($array[$nombre]);
        }
        return $valor;
    }
    
    static function leerClase(string $nombreClase, string $funcionGet = 'getAtributos', string $funcionSet = 'setAtributos'){
         return self::leerObjeto(new $nombreClase(), $funcionGet, $funcionSet);
    }
    
    static function leerObjeto($objeto, string $funcionGet = 'getAtributos', string $funcionSet = 'setAtributos') {
        if(method_exists($objeto, $funcionGet) && method_exists($objeto, $funcionSet)) {
            $atributos = $objeto->$funcionGet();
            foreach($atributos as $indice => $valor) {
                $atributos[$indice] = self::leer($indice);
            }
            $objeto->$funcionSet($atributos);
        } else {
            $objeto = null;
        }
        return $objeto;
    }
}
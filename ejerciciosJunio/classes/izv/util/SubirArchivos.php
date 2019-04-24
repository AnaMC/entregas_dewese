<?php


namespace izv\util;

class SubirArchivoss {

    const   
        MANTENER = 1,
        SOBREESCRIBIR = 2,
        RENOMBRAR = 3,
        ERROR = 1000;
            
    //Variables de instancia
    private $error = 0,
            $file,
            $input,
            $tamanoMaximo = 2, //mb
            $tamanoMinimo = 32, //kb
            $nombre,
            $nombreGuardado = '',
            $accion = self::RENOMBRAR,
            $destino = './',
            $type = array('jpg','png');

 //$file se supone que es un String
    function __construct($input) {
        $this->input = $input;
        if(isset($_FILES[$input]) && $_FILES[$input]['name'] != '') {
            $this->file = $_FILES[$input];
            $this->nombre = $this->file['name'];
        } else {
            $this->error = 1;
        }
    }
    
    private function __doSube() {
        $result = false;
        switch($this->accion) {
            case self::MANTENER:
                $result = $this->__doSubeMantener();
                break;
            case self::SOBREESCRIBIR:
                $result = $this->__doSubeSobreEscribir();
                break;
            case self::RENOMBRAR:
                $result = $this->__doSubeRenombrar();
                break;
        }
        if(!$result && $this->error === 0){
            $this->error = 4;
        }
        return $result;
    }
    
    private function __doSubeMantener() {
        $result = false;
        if(file_exists($this->destino . $this->nombre) === false) { //Si es falso no existe, si no existe lo creamos
            $result = move_uploaded_file($this->file['tmp_name'], $this->destino . $this->nombre); // t-f
        } else {
            $this->error = 3;
        }
        return $result;
    }
    
    // move_uploaded_file -> DEV. t/f
    private function __doSubeSobreEscribir() {
        return move_uploaded_file($this->file['tmp_name'], $this->destino . $this->nombre);
    }
    
    private function __doSubeRenombrar() {
        $newName = $this->destino . $this->nombre;
        if(file_exists($newName)) {
            $newName = self::__obtenerRenombre($newName);
        }
        
        return move_uploaded_file($this->file['tmp_name'], $newName);
    }
    
    private static function __obtenerRenombre($file) {
    
        // pathinfo — Devuelve información acerca de la ruta de un fichero
        $info = pathinfo($file);
        $extension = '';
        if(isset($info['extension'])) {
            $extension = '.' . $info['extension'];
        }
        $cont = 1;
        
        while(file_exists($info['dirname'] . '/' . $info['filename'] . $cont . $extension)) {  // images/foto1.jpg
            $cont++;
        }
        
        $this->nombreGuardado = $parts['filename'] . $cont . $extension; 
        return $info['dirname'] . '/' . $parts['filename'] . $cont . $extension;
    }

    function getError() {
        $error = $this->error + self::ERROR;
        
        //PARA SABER SI EL ERROR ES NUESTRO O DE PHP
        if($error === self::ERROR) {
            $error = $this->file['error'];
        }
        return $error;
    }
    function getNombre() {
        $nombre = $this->nombreGuardado;
        if($nombre !== ''){
            $nombre =$this->nombre;
        }
        return $nombre;
    }

    function getTamanoMaximo() {
        return $this->tamanoMaximo;
    }
    
    function getTamanoMinimo() {
        return $this->tamanoMinimo;
    }
    
    // function tamanoValido() {
    //     return ($this->tamanoMaximo === 0 || $this->maxSize >= $this->file['size']);
    // }
    
    // file['size'] -> Devuelve el tamaño en bytes
    function tamanoValido() {
        $minimoBytes = $tamanoMinimo * 1000; //Para convertir los kb en bytes
        $maximoBytes = $tamanoMaximo * 1000000; //Para convertir los mb en bytes
        
        $tamanoArchivo = $this->file['size'];
        if ($tamanoArchivo < tamanoMinimo || $tamanoArchivo > tamanoMaximo){
            $this->error =  5; 
            
            echo 'Tamaño de archivo inválido'; 
        }
        
      return $tamanoArchivo;
    }
    
    function tipoValido() {
        $valido = true;
        if($this->type !== '') {
            // shell_exec — Ejecutar un comando mediante el intérprete de comandos 
            // y devolver la salida completa como una cadena
            $tipo = shell_exec('file --mime ' . $this->file['tmp_name']);
            // strpos — Encuentra la posición de la primera ocurrencia de un substring en un string
            $posicion = strpos($tipo, $this->type);
            if($posicion === false) {
                $valid = false;
            }
        }
        return $valid;
    }
    
 //$size se supone que es un Number
    function setMaxSize($size) {
        if(is_int($size) && $size > 0) {
            $this->maxSize = $size;
        }
        return $this;
    }

    function setName($name) {
        if(is_string($name) && trim($name) !== '') {
            $this->name = trim($name);
        }
        return $this;
    }
//$policy se supone que es un Number
    function setPolicy($policy) {
        if(is_int($policy) && $policy >= self::ERROR && $policy <= self::RENOMBRAR) {
            $this->policy = $policy;
        }
        return $this;
    }

    //$target se supone que es un String
    function setDestino($destino) {
        if(is_string($destino) && trim($destino) !== '') {
            $this->destino = trim($destino);
        }
        return $this;
    }
    
    //Obliga a que el parrámetro sea un array
    function setType (array $type) {
        //Comprobacion de tipos permitidos
        if(is_string($type) && trim($type) !== '') {
            $this->type = trim($type);
        }
        return $this;
    }

   function upload() {
        $result = false;
        if($this->error !== 1 && $this->file['error']=== 0) {
            if($this->isValidSize() && $this->isValidType()) {
                $this->error = 0;
                $result = $this->__doUpload();
            } else {
                $this->error = 2;
            }
        }
        return $result;
    }
}
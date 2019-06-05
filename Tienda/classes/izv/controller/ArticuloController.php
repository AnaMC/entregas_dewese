<?php

namespace izv\controller;

use izv\data\Articulo;
use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Util;

class ArticuloController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        // $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('titulo', 'Articulo Controller');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'Articulo Controller');
    }
    
    function registroArticulo(){
        
        $resultado = Reader::read('resultado');
        
        if($resultado != null){
                                    //Clave , valor [para feedback]
            $this->getModel()->set('respuesta', $resultado);
        }
        $this->getModel()->set('twigFile', '_articuloRegister.twig');
    }
    
    function doRegistroArticulo(){
        $articulo = Reader::readObject('izv\data\Articulo');  
        
        // echo Util::varDump($articulo);
        // exit();
        
        $resultado = $this->getModel()->registroArticulo($articulo);

        if($resultado != 0 && $resultado != -1){
         
            header('Location: ' . App::BASE . 'articulo/registroArticulo?resultado=' . $resultado ? '1' : '0' );
        }
        header('Location: ' . App::BASE . 'articulo/registroArticulo?resultado=' . $resultado );
    }
    
}
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
        $this->getModel()->set('admin', $this->isAdmin());
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
    
    function paginacionArticulos() {
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        
        $resultado = $this->getModel()->getArticulosPaginados($pagina);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('twigFile', '_tablasProduct.twig');
    }
 
    function doBorrarArticulo(){
        $admin = $this->isAdmin();
        if($admin){
            $id = Reader::read('id');
            // var_dump($id);
            // exit();
            $resultado = $this->getModel()->borrarArticulo($id);
            $r = $resultado === null ? 1 : 0;
            header('Location: paginacionArticulos?op=borrado&result='. $r);
            exit();
        }
           header('Location: paginacionArticulos?op=borrado&result=1');
    } 
    
    function editarArticulo(){
        $id = Reader::read('id');
        $resultado = $this->getModel()->getArticulo($id);
        if($resultado != null){     //Clave , valor [para feedback]
            $this->getModel()->set('info', $resultado);
            $this->getModel()->set('id', $id);
            $this->getModel()->set('edit', true);
        }
        
        $this->getModel()->set('twigFile', '_articuloEdit.twig');
        
    }
    
    function doEditarArticulo(){
        // $id = Reader::read('id');
        $articulo = Reader::readObject('izv\data\Articulo');
        // var_dump($id);
        // exit();
        $resultado = $this->getModel()->editar($articulo);  
        // $r = $resultado->getId() === null ? 1 : 0;
        $admin = $this->isAdmin();
        if($admin){
            header('Location: paginacionArticulos?op=login&res=' . $r);
            exit();
        }else{
            header('Location: paginacionArticulos?op=login&res=' . $r);
            exit();
        }
        exit();
    }
    
    
}
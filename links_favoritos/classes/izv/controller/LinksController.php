<?php

namespace izv\controller;

use izv\tools\Session;
use izv\app\App;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Mail;

class LinksController extends Controller {
    
    function __construct( $model) {
        //Llamamos al Constructor padre
        parent::__construct($model);
        
        if(!$this->getSession()->isLogged() ){
            //Si no está logeado lo mandamos al login
            header('Location: ' . App::BASE . 'login');
        }
    }
    
    function main(){                           //Indicamos tipo de archivo y plantilla a renderizar
        $this->getModel()->set('twigFile','_listarLink.html');
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)){
            $pagina = 1;
        }
        
        $orden = Reader::read('orden');
        //Ver si llega el campo
         if(!isset($ordenes[$orden])){
            $orden = 'c.categoria';
        }
        
        $links = $this->getModel()->getListaLinks($this->getSession()->getLogin()->getId(), $pagina, $orden);
        // echo Util::varDump($links);
        // exit();
        $this->getModel()->set('links', $links);
    }
    
    function agregarLink(){
        $this->getModel()->set('twigFile','_agregarLink.html');   
        $categorias =  $this->getModel()->getCatUser($this->getSession()->getLogin()->getId() );
        // echo Util::varDump($categorias);
        // exit();
        $this->getModel()->set('categorias', $categorias);
    }

    // function mostrarLink(){
    //     $this->getModel()->set('twigFile','_listarLink.html');
        
    // }
    }
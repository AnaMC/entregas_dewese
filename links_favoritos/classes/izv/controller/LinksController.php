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
    
    function main(){
                            //Indicamos tipo de archivo y plantilla a renderizar
        $this->getModel()->set('twigFile','_listarLink.html');
    }
    
    function agregarLink(){
        $this->getModel()->set('twigFile','_agregarLink.html');   
    }

}
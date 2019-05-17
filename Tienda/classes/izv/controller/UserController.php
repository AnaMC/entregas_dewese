<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Mail;
use izv\tools\Util;

class UserController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('titulo', 'User Controller');
        $this->getModel()->set('twigFile', '_base.twig');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'User Controller');
    }
    
     function registro(){
        
        $resultado = Reader::read('resultado');
        
        if($resultado != null){
                                    //Clave , valor [para feedbac]
            $this->getModel()->set('respuesta', $resultado);
        }
         
        $this->getModel()->set('twigFile', '_register.twig');
        
    }
    
    function doRegistro(){
     $usuario = Reader::readObject('izv\data\Usuario');  
    
       if(strlen(trim($usuario->getClave())) >= 6 && strlen(trim($usuario->getNombre())) >= 3 && strlen(trim($usuario->getAlias())) >= 3){
          //Antes de hacer flush encriptamos la clave
           $usuario->setClave(Util::encriptar($usuario->getClave()));
           $resultado = $this->getModel()->registroUsuario($usuario);

           if($resultado != 0 && $resultado != -1){
               //Si exito -> email confirmacion
                $resultado = Mail::sendActivation($usuario);
                
                header('Location: ' . App::BASE . 'usuario/registro?resultado=' . $resultado ? '1' : '0' );
           }
       }
       header('Location: ' . App::BASE . 'usuario/registro?resultado=' . $resultado );
    }
    
}
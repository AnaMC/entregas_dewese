<?php

namespace izv\controller;

use izv\data\Usuario;
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
    
    private function isAdministrator() {
        return $this->getSession()->isLogged() && $this->getSession()->getLogin()->getTipo() === 1;
    }
    
    function registro(){
        
        $resultado = Reader::read('resultado');
        
        if($resultado != null){
                                    //Clave , valor [para feedback]
            $this->getModel()->set('respuesta', $resultado);
        }
        $this->getModel()->set('twigFile', '_adminRegister.twig');
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
    
      function doActivar(){
        $id = Reader::read('id');
        $c ='izv\data\Usuario';
        $usuario = $this->getModel()->getEntityManager()->getRepository($c)->findOneBy([
                'id' => $id]);
        $usuario->setActivo('1');
        
            $this->getModel()->getEntityManager()->flush();
            header('Location: ' . App::BASE . 'usuario/login');
    }
    
    
    function login() {
        $this->getModel()->set('twigFile', '_login.twig');
    }
    
  function doLogin(){
        // Recogemos los datos que nos han llegado del usuario
        // Comprobamos datos bd
        // Comprobacion Contraseña
        // Hacemos el logueo
        $correoUsuario = Reader::read('correo');
        $claveUusario = Reader::read('clave');
        //Guardamos la ruta de la clase para poder utilizarla en el getRepository
        $c='izv\data\Usuario';
        
        $usuario = $this->getModel()->getEntityManager()->getRepository($c)->findOneBy([
                'correo' => $correoUsuario
            ]);
            
        if (!empty($usuario)) {
            $resultado = Util::verificarClave($claveUusario, $usuario->getClave()); 
            $activo = $usuario -> getActivo();
            if($resultado && $activo ===1){
               $this->getSession()->login($usuario);
               header('Location: usuario/registro?op=login&res=1');
               exit();
            } 
        }
        header('Location: login/main?op=login&res=0');
    }
    
    
}
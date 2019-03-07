<?php

namespace izv\controller;

use izv\tools\Session;
use izv\app\App;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Mail;

class LoginController extends Controller {
    
    /*
        proceso general:
        1º control de sesión
        2º lectura de datos
        3º validación de datos
        4º usar el modelo
        5º producir resultado (para la vista)
    */
    
    function __construct( $model) {
        //Llamamos al Constructor padre
        parent::__construct($model);
        
        if($this->getSession()->isLogged() ){
            //Si está logeado lo mandamos al main
            header('Location: ' . App::BASE . 'login');
        }
    }
    
    function main(){
                            //Indicamos tipo de archivo y plantilla a renderizar
        $this->getModel()->set('twigFile','_login.html');
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
            
            if($resultado){
               $this->getSession()->login($usuario);
               header('Location: index/main?op=login&res=1');
               exit();
            } 
        }
        header('Location: login/main?op=login&res=0');
    }
    
    function doLogOut() {
        $this->getSession()->logout();
        header('Location: index/main');
        exit();
    }
    
    function registro(){
        $this->getModel()->set('twigFile','_register.html');
    }
    

    function doRegistro(){
       //Le pasamos la clase que queremos leer
       $usuario = Reader::readObject('izv\data\Usuario');  
    //   echo Reader::read('correo');
    //   echo Reader::read('nombre');
    //   echo Reader::read('alias');
    //   echo Reader::read('clave');
    //   echo Util::varDump($usuario);
    //   exit();
    
       //strlen equivalente a .length
       if(strlen(trim($usuario->getClave())) >= 6 && strlen(trim($usuario->getNombre())) >= 3 && strlen(trim($usuario->getAlias())) >= 3){
          //Antes de hacer flush encriptamos la clave
           $usuario->setClave(Util::encriptar($usuario->getClave()));
           $resultado = $this->getModel()->crearUsuario($usuario);
           
        //   echo Util::varDump($resultado);
        //   exit();
           if($resultado != 0 && $resultado != -1){
               
               //Si exito -> email confirmacion
                $resultado = Mail::sendActivation($usuario);
                
                header('Location: ' . App::BASE . 'login/mail?result=' . $resultado ? '1' : '0' );
           }
       }
       header('Location: ' . App::BASE . 'login/mail?result=0' );
    }
}
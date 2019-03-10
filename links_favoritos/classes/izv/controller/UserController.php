<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class UserController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }

    function main() {
        //1º control de sesión
        if($this->getSession()->isLogged()) {
            $this->getModel()->set('twigFile', '_mainlogged.html');
            $usuario =$this->getSession()->getLogin()->getUnset(['fechaalta','links', 'categorias']);
            
            $this->getModel()->set('user', $usuario);
            if($this->isAdministrator()) {
                $this->getModel()->set('administrador', true);
            }
        } else {
            //5º producir resultado
            $this->getModel()->set('twigFile', '_main.html');
        }
    }

    private function isAdministrator() {
        return $this->getSession()->isLogged() && $this->getSession()->getLogin()->getCorreo() === 'admin@admin.es';
    }
    /*
    proceso general:
    1º control de sesión
    2º lectura de datos
    3º validación de datos
    4º usar el modelo
    5º producir resultado (para la vista)
    */

    function agregar(){
        $this->getModel()->set('twigFile','_agregar.html');
    }
    
    function doAgregar(){
        if($this->isAdministrator()){
            $newUser = Reader::readObject('izv\data\Usuario');
           
            $newUser->setClave(Util::encriptar($newUser->getClave()));
            $resultado = $this->getModel()->crearUsuario($newUser);
           
        }
        header('Location: ' . App::BASE . 'login/mail?result=0' );
    }
    
    function editar() {
        $id_usuario = Reader::read('id');
        $user = $this->getModel()->getUsuario($id_usuario);
        $session = $this->getSession()->getLogin();
        if($user === null || $session->getRol() != 1 && $session->getId() != $id_usuario){
            header('Location: ' . App::BASE . 'index/main');
           exit(); 
        }
        
        $this->getModel()->set('usuario', $user);
        $this->getModel()->set('rol', $session->getRol());
        $this->getModel()->set('twigFile','_editar.html');
    }
    
    function doEditar() {

        if($this->isAdministrator()){
           $usuario = Reader::readObject('izv\data\Usuario');
           $rol_usuario = Reader::read('rol');
           $usuario->setRol($rol_usuario === 'on' ? 1 : 0);
           $resultado = $this->getModel()->editarUsuario($usuario);
           header('Location: ' . App::BASE . 'index/listar?result=1');
           exit();
        }
       header('Location: ' . App::BASE . 'index/listar'); 
    }
    
    function doBorrar(){
        if($this->isAdministrator()){
            $id = Reader::read('id');
            $resultado = $this->getModel()->borrarUsuario($id);
            $r = $resultado->getId() === null ? 1 : 0;
              header('Location: ' . App::BASE . 'index/listar?result=' . $r);
              exit();
        }
       header('Location: ' . App::BASE . 'index/listar'); 
    }

    function listar(){
          $pagina = Reader::read('pagina');
          
          $resultado = $this->getModel()->getUsuarios($pagina);
          $this->getModel()->set('usuarios', $resultado);
          //Le pasamos el usuario a la vista para saber sus datos
          $this->getModel()->set('user', $this->getSession()->getLogin());
          $this->getModel()->set('twigFile','_listar.html');
    }

}
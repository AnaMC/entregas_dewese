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
        $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('titulo', 'User Controller');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'User Controller');
    }
    
    function registro(){
        
        $resultado = Reader::read('resultado');
        
        if($resultado != null){
                                    //Clave , valor [para feedback]
            $this->getModel()->set('respuesta', $resultado);
        }
        // $this->getModel()->set('twigFile', '_adminRegister.twig');
        $this->getModel()->set('twigFile', '_new_register.twig');
    }
    
    function doRegistro(){
     $usuario = Reader::readObject('izv\data\Usuario');  
    
       if(strlen(trim($usuario->getClave())) >= 6 && strlen(trim($usuario->getNombre())) >= 3 && strlen(trim($usuario->getAlias())) >= 3){
          //Antes de hacer flush encriptamos la clave
           $usuario->setClave(Util::encriptar($usuario->getClave()));
        //   echo Util::varDump ($usuario);
        //   exit();
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
            // header('Location: ' . App::BASE . 'usuario/login');
            Util::redirect(App::BASE . 'usuario/login');
    }
    
    //Plantilla que va a mostrar
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
            $nombre = $usuario->getNombre(); 
            
            if (!empty($usuario)) {
                $resultado = Util::verificarClave($claveUusario, $usuario->getClave()); 
                $activo = $usuario -> getActivo();
                $admin = $this->isAdmin();
                if($resultado && $activo ===1){
                   $this->getSession()->login($usuario);
                  if($admin){
                        header('Location: paginacion?op=login&res=1');
                  exit();
                  }else{
                        header('Location: paginacion?op=login&res=1');
                  exit();
                  }
                } 
            }
            header('Location: login/registro?op=login&res=0');
    }
    
    function doLogout(){
      $this->getSession()->logout();
        // header('Location: login');
        // exit();
        Util::redirect(App::BASE . 'usuario/login');
    }
   
    function logged(){
        if($this->getSession()->getLogin()){
            $id = $this->getSession()->getLogin()->getId();
            $resultado = $this->getModel()->getUsuario($id);
            $this->getModel()->set('info', $resultado);
            $this->getModel()->set('twigFile','_tablas.twig');
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
             Util::redirect(App::BASE . 'usuario/login');
        }
    }
    
    function listar(){
        if($this->getSession()->getLogin()){
            $resultado = $this->getModel()->getUsuarios();
          
            $this->getModel()->set('info', $resultado);
            $this->getModel()->set('admin', $this->isAdmin());
            $this->getModel()->set('twigFile','_tablas.twig');
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
             Util::redirect(App::BASE . 'usuario/login');
        }
    } 
    
    function doBorrar(){
        $admin = $this->isAdmin();
        if($admin){
            $id = Reader::read('id');
            // var_dump($id);
            // exit();
            $resultado = $this->getModel()->borrarUsuario($id);
            $r = $resultado->getId() === null ? 1 : 0;
            // header('Location: ' . App::BASE . 'index/listar?result=' . $r);
            header('Location: paginacion?op=borrado&result='. $r);
            exit();
        }
        //   header('Location: ' . App::BASE . 'index/listar'); 
           header('Location: paginacion?op=borrado&result=1');
    }
        
    function editar(){
        if($this->getSession()->getLogin()){
            $id = Reader::read('id');
            $resultado = $this->getModel()->getUsuario($id);
            if($resultado != null){
                                        //Clave , valor [para feedback]
                $this->getModel()->set('info', $resultado);
            }
            
            $this->getModel()->set('twigFile', '_edit.twig');
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
             Util::redirect(App::BASE . 'usuario/login');
        }
    }
    
    function doEditar(){
        $usuario = Reader::readObject('izv\data\Usuario');
        // var_dump($id);
        // exit();
        $resultado = $this->getModel()->editar($usuario);  // $r = $resultado->getId() === null ? 1 : 0;
        $admin = $this->isAdmin();
        if($admin){
            header('Location: listar?op=login&res=' . $r);
            exit();
        }else{
            header('Location: logged?op=login&res=' . $r);
            exit();
        }
        exit();
    }
    
    // Paginacion
    
     function paginacion() {
        if($this->getSession()->getLogin()){
            $pagina = Reader::read('pagina');
            
            if($pagina === null || !is_numeric($pagina)) {
                $pagina = 1;
            }
            
            $resultado = $this->getModel()->getUsuariosPaginados($pagina);
            // echo Util::varDump($resultado);
            // exit();
            $this->getModel()->add($resultado);
            $this->getModel()->set('admin', $this->isAdmin());
            $this->getModel()->set('twigFile', '_tablas.twig');
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
             Util::redirect(App::BASE . 'usuario/login');
        }
    }
}
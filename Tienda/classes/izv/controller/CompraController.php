<?php

namespace izv\controller;

use izv\data\Articulo;
use izv\data\Detalle;
use izv\data\Pedido;
use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Util;

class CompraController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        // $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('titulo', 'Compra Controller');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'Compra Controller');
    }
   
    function paginacionPedidos() {
        if($this->getSession()->getLogin()){ 
             
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        $id = $this->getSession()->getLogin()->getId();
        $resultado = $this->getModel()->getPedidosPaginados($pagina, $id);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('twigFile', '_tablasPedidos.twig');
        
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
             Util::redirect(App::BASE . 'usuario/login');
        }
    }
    
     function paginacionPedidosUsuarios() {
        if($this->getSession()->getLogin()){ 
            
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        $resultado = $this->getModel()->getPedidosPaginadosUsuarios($pagina);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('twigFile', '_tablasPedidosUsuarios.twig');
        
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
              Util::redirect(App::BASE . 'usuario/login');
        }
    }
 
    function doBorrarPedido(){
        if($this->getSession()->getLogin()){ 
            $admin = $this->isAdmin();
            if($admin){
                $id = Reader::read('id');
                // var_dump($id);
                // exit();
                $resultado = $this->getModel()->borrarPedido($id);
                $r = $resultado === null ? 1 : 0;
                header('Location: paginacionPedidos?op=borrado&result='. $r);
                exit();
            }
               header('Location: paginacionPedidos?op=borrado&result=1');
        }else{
            //  header('Location: ' . App::BASE . 'usuario/login');
              Util::redirect(App::BASE . 'usuario/login');
        }
    } 
    
    function paginacionArticulos() {
        if($this->getSession()->getLogin()){ 
            $pagina = Reader::read('pagina');
            
            if($pagina === null || !is_numeric($pagina)) {
                $pagina = 1;
            }
    
        $resultado = $this->getModel()->getArticulosPaginados($pagina);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
        $this->getModel()->set('twigFile', '../perfect_woman/_lencemplateria.twig');
        }else{
                //  header('Location: ' . App::BASE . 'usuario/login');
                 Util::redirect(App::BASE . 'usuario/login');
        }

    }
}
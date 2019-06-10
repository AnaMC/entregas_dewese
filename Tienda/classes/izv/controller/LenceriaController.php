<?php

namespace izv\controller;

use izv\data\Articulo;
use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Util;

class LenceriaController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('twigFile', '/_lenceria.twig');  
    }
    
    function main() {
        $this->getModel()->set('titulo', 'Articulo Controller');
        $pagina_br = Reader::read('pagina-br');
        $pagina_len = Reader::read('pagina-len');
        $pagina_body = Reader::read('pagina-body');
        
        if($pagina_br === null || !is_numeric($pagina_br)) {
            $pagina_br = 1;
        }
        
        if($pagina_len === null || !is_numeric($pagina_len)) {
            $pagina_len = 1;
        }
        
        $resultado_br = $this->getModel()->getBraguitaPaginado($pagina_br);
        // echo Util::varDump($resultado);
        // exit();
        // var_dump($resultado_br['paginas_br']);
        
        $resultado_len = $this->getModel()->getLenceriaPaginada($pagina_len);
        
        $this->getModel()->add($resultado_br);
        $this->getModel()->add($resultado_len);
        $this->getModel()->set('admin', $this->isAdmin());
        
        $resultado_body = $this->getModel()->getBodyPaginado($pagina_body);
        
        $this->getModel()->add($resultado_br);
        $this->getModel()->add($resultado_len);
        $this->getModel()->add($resultado_body);
        $this->getModel()->set('admin', $this->isAdmin());
    }
    
    function paginacionBraguitas() {
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        
        $resultado = $this->getModel()->getBraguitaPaginado($pagina);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
    }
    
    
    function doComprar(){
        if($this->getSession()->getLogin()){
            $articuloId = Reader::read('id');
            $usuarioId = $this->getSession()->getLogin()->getId();
            $resultado = $this->getModel()->comprarArticulo($articuloId, $usuarioId);
            header('Location: main?op=compra&result=' . $resultado);
         }else{
            header('Location: ' . App::BASE . 'usuario/login');
         }
    }
}
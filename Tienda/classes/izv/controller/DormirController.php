<?php

namespace izv\controller;

use izv\data\Articulo;
use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Util;

class DormirController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('twigFile', '/_ropa_dormir.twig');  
    }
    
    function main() {
        
            $this->getModel()->set('titulo', 'Articulo Controller');
            $pagina_cor = Reader::read('pagina-cor');
            $pagina_homew = Reader::read('pagina-homew');
            $pagina_cami = Reader::read('pagina-cami');
            
            if($pagina_cor === null || !is_numeric($pagina_cor)) {
                $pagina_cor = 1;
            }
            
            if($pagina_homew === null || !is_numeric($pagina_homew)) {
                $pagina_homew = 1;
            }
            
            if($pagina_cami === null || !is_numeric($pagina_cami)) {
                $pagina_cami = 1;
            }
            
            $resultado_cor = $this->getModel()->getPijamaPaginado($pagina_cor);
            $this->getModel()->add($resultado_cor);
            
            $resultado_homew = $this->getModel()->getHomewPaginado($pagina_homew);
            $this->getModel()->add($resultado_homew);
            
            $resultado_cami = $this->getModel()->getCamiPaginado($pagina_cami);
            $this->getModel()->add($resultado_cami);
            
            $this->getModel()->add($resultado_cor);
            $this->getModel()->add($resultado_homew);
            $this->getModel()->add($resultado_cami);
            
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
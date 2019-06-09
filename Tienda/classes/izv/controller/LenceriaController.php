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
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        
        $resultado = $this->getModel()->getLenceriaPaginada($pagina);
        // echo Util::varDump($resultado);
        // exit();
        $this->getModel()->add($resultado);
        $this->getModel()->set('admin', $this->isAdmin());
    }
    
    function doComprar(){
        $articuloId = Reader::read('id');
        $usuarioId = $this->getSession()->getLogin()->getId();
        $resultado = $this->getModel()->comprarArticulo($articuloId, $usuarioId);
        header('Location: main?op=compra&result=' . $resultado);
    }
    
}
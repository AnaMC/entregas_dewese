<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class AjaxController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        
        if(!$this->getSession()->isLogged() ){
            $this->getModel()->set('resultado', ['estado' => '-1']);
            exit();
        }
    }

    function main() {}

    function agregarCategoria(){
        
        $categoria = Reader::readObject('izv\data\Categoria');
        $result = 0;
        
        if($categoria != null && trim($categoria->getCategoria()) !== ''){
            $resultado = $this->getModel()->agregarCategoria($this->getSession()->getLogin()->getId(),$categoria);
            $result = 1;
        }
        
          $this->getModel()->set('result',$result);
          $this->getModel()->set('id_categoria',$resultado->getId());
          $this->getModel()->set('nombre',$resultado->getCategoria());
    }
    
    function borrarlink(){
        $idlink = Reader::read('id');
        $result = $this->getModel()->delete($idlink);
        $this->getModel()->set('result', ($result->getId() === null) ? 1 : 0);
    }
    
    function agregarLink(){
        $link = Reader::readObject('izv\data\Link');
        $categoria = Reader::read('categoria');
        $usuario_id = $this->getSession()->getLogin()->getId();
        
        $resultado = $this->getModel()->insertarLink($usuario_id, $categoria, $link);
        
        if($resultado->getId() > 0){
            $this->getModel()->set('result', 1);
        }else{
            $this->getModel()->set('result', 0);
        }
    }
    
    function mostrarLinks(){
        
        $ordenes = [
                    'l.href' => '',
                    'c.categoria' => '',
                    'l.comentario' => ''
                    ];
        $pagina = Reader::read('pagina');
        
        if($pagina === null || !is_numeric($pagina)){
            $pagina = 1;
        }
        
        $orden = Reader::read('orden');
        //Ver si llega el campo
         if(!isset($ordenes[$orden])){
            $orden = 'c.categoria';
        }
        
        $links = $this->getModel()->getListaLinks($this->getSession()->getLogin()->getId(), $pagina, $orden);
        // echo Util::varDump($links);
        // exit();
        $this->getModel()->set('links', $links);
    }
    
}
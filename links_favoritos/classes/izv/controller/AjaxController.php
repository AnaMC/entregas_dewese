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
        
        $categoria = Read::ReadObject('izv\data\Categoria');
        $resultado = 0;
        
        if($categoria != null && trim($categoria->getCategoria()) !== ''){
            $resultado = $this->getModel()->agregarCategoria($this->getSession()->getLogin()->getId(),$categoria);
            $resultado = 1;
        }
        
          $this->getModel()->set('resultado',$resultado);
    }
}
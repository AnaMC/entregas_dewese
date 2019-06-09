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
    }
    
    
}
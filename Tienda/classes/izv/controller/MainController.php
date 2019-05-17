<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class MainController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('titulo', 'Main Controller');
        $this->getModel()->set('twigFile', '../admintemplate/_base.twig');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'Main Controller');
    }
    
    // function registro(){
    //     $this->getModel()->set('twigFile', '_register.twig');
    // }
}
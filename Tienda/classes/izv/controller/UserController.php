<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class UserController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('titulo', 'User Controller');
        $this->getModel()->set('twigFile', '_base.twig');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'User Controller');
    }
    
     function registro(){
        $this->getModel()->set('twigFile', '_register.twig');
    }
    
}
<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

class UserView extends View {
    
    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('twigFolder', 'twigtemplates/admintemplate');
        // La que se mostrará por defecto
        $this->getModel()->set('twigFile', '_index.twig');
    }

    function render($accion) {
        $data = $this->getModel()->getViewData();
        $loader = new \Twig_Loader_Filesystem($data['twigFolder']);
        $twig = new \Twig_Environment($loader);
        return $twig->render($data['twigFile'], $data);
    }
    
}
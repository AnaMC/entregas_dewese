<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

class DormirView extends View {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('twigFolder', 'twigtemplates/perfect_woman');
        $this->getModel()->set('twigFile', '_ropa_dormir.twig');
    }

    function render($accion) {
        $data = $this->getModel()->getViewData();
        $loader = new \Twig_Loader_Filesystem($data['twigFolder']);
        $twig = new \Twig_Environment($loader);
        return $twig->render($data['twigFile'], $data);
    }
}
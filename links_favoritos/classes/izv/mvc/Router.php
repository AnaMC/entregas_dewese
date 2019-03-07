<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            'admin' => new Route('AdminModel', 'AdminView' , 'UserController'),
            'index' => new Route('UserModel', 'MaundyView', 'UserController'),
            'ajax' => new Route('UserModel', 'AjaxView', 'AjaxController'),
            'login' => new Route('LoginModel', 'MaundyView', 'LoginController'),
            'listar' => new Route ('UserModel', 'MaundyView', 'UserController'),
            'links' => new Route ('LinksModel', 'MaundyView', 'LinksController')
            //'old'   => new Route('FirstModel', 'FirstView' , 'FirstController'),
            //'zeta'  => new Route('FirstModel', 'SecondView', 'FirstController')
        );
        $this->ruta = $ruta;
    }

    function getRoute() {
        $ruta = $this->rutas['index'];
        if(isset($this->rutas[$this->ruta])) {
            $ruta = $this->rutas[$this->ruta];
        }
        return $ruta;
    }
}
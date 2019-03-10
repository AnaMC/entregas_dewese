<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            'admin' => new Route('AdminModel', 'AdminView' , 'UserController'),
            'index' => new Route('UserModel', 'MaundyView', 'UserController'),
            'login' => new Route('LoginModel', 'MaundyView', 'LoginController'),
            'listar' => new Route ('UserModel', 'MaundyView', 'UserController'),
            //AjaxView no renderiza en pantalla, si no que codifica a json
            'ajax' => new Route('LinksModel', 'AjaxView', 'AjaxController'),
            'links' => new Route ('LinksModel', 'MaundyView', 'LinksController')
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

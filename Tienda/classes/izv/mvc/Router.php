<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            //RUTAS
            'index'     => new Route('Model', 'MainView' , 'MainController'),
            'usuario'  => new Route('UserModel', 'UserView', 'UserController'),
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

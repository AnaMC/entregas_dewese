<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            //RUTAS
            'index'     => new Route('Model', 'MainView' , 'MainController'),
            'usuario'  => new Route('UserModel', 'UserView', 'UserController'),
            // ↓ Compras reales aquí
            'articulo'  => new Route('ArticuloModel', 'UserView', 'ArticuloController'),
            'lenceria'  => new Route('ArticuloModel', 'LenceriaView', 'LenceriaController'),
            'dormir'  => new Route('ArticuloModel', 'DormirView', 'DormirController'),
            // ↓ Gestón de pedidos
            'compra'  => new Route('CompraModel', 'UserView', 'CompraController'),
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

<?php

require('../classes/autoload.php');
require('../classes/vendor/autoload.php');

$bs = new izv\tools\Bootstrap();

$gestor = $bs->getEntityManager();

// Usuarios

// $usuario = new izv\data\Usuario();

// $usuario->setNombre('Alex');
// $usuario->setApellidos('Gonsales');
// $usuario->setAlias('Algo');
// $clave = izv\tools\Util::encriptar('456');
// $usuario->setClave($clave);
// $usuario->setCorreo('algo@pe.es');

// $gestor->persist($usuario);
// $gestor->flush();

// Productos

// $articulo = new izv\data\Articulo();

// $articulo->setNombre('cosa1');
// $articulo->setPrecio('2');
// $articulo->setCantidad('10');
// $articulo->settallaDesde('s');
// $articulo->settallaHasta('xl');
// $articulo->setDescripcion('Muy bonito ');
// $articulo->setTipo('Superior ');

// $gestor->persist($articulo);
// $gestor->flush();

//Favoritos

// $favorito = new izv\data\Favorito();

// $usuario = $gestor->getReference('izv\data\Usuario', 2);
// $favorito->sethref('www.cosa2.es');
// $favorito->setcomentario('eweeeeeee');
// $favorito->setusuario($usuario); //_______________↑

// $gestor->persist($favorito);
// $gestor->flush();

// Pedidos

// $pedido = new izv\data\Pedido();

// // $ = $gestor->getReference('izv\data\Articulo', 1);
// $usuario = $gestor->getReference('izv\data\Usuario', 2);
// $pedido->setFormaPago('visa');
// $pedido->setUsuario($usuario); //_______________↑

// $gestor->persist($pedido);
// $gestor->flush();


// Detalles

// $detalle = new izv\data\Detalle();

// $articulo = $gestor->getReference('izv\data\Articulo', 1);
// $pedido = $gestor->getReference('izv\data\Pedido', 1);
// $detalle->setPrecio(22.3);
// $detalle->setCantidad(10);
// $detalle->setArticulo($articulo); //_______________↑
// $detalle->setPedido($pedido);
// $gestor->persist($detalle);
// $gestor->flush();


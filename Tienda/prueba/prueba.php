<?php

require('../classes/autoload.php');
require('../classes/vendor/autoload.php');

$bs = new izv\tools\Bootstrap();

$gestor = $bs->getEntityManager();

$usuario = new izv\data\Usuario();

$usuario->setNombre('pepe');
$usuario->setApellidos('lopez');
//$usuario->setAlias('pelo');
//$usuario->setClave('clave');
$usuario->setCorreo('pelo@pelo.es');

$gestor->persist($usuario);
$gestor->flush();
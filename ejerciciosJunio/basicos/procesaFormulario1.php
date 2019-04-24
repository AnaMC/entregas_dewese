<?php

require_once('../classes/izv/data/Matricula.php');
require_once('../classes/izv/util/Parametros.php');

use izv\data\Matricula;
use izv\util\Parametros;

//Leemos las variables que nos llegan

// $nombre = $_POST['nombre'];

// // Si el valor me llega hago el echo, si no llega, no escribe ningún error
// if(isset($_POST['nombre'])) {
//     $nombre = $_POST['nombre'];
//     echo 'el nombre es: ' . $nombre;
// }

// echo 'El nombre es ' . $nombre;

// Utilizando la clase Parametros no temenemos que leerlos uno a uno, ya que esta lo hace sola, inconveniente -> Hay que repetirlo tantas veces como campos
// $nombre = Parametros::leerPost('nombre');

//version A
//$matricula = new Matricula();
//$matricula->leer();

//version B !!!
//$matricula = Matricula::leer();
//var_dump($matricula);

//version C
//$matricula = new Matricula();
//Parametros::leer($matricula);

//version D
$matricula = Parametros::leerClase('izv\data\Matricula');
echo $matricula;
//$matricula = Parametros::leerObjeto(new Matricula());
//$matricula = Parametros::leerString('izv\data\Matricula', 'funcionGet', 'funcionSet');

<?php

require_once('../classes/autoload.php');

use izv\data\Matricula;

//¿Como afecta en valor de las variables

function f($a, $b) {
    $a = $a + 1;
    $b = $b +$a;
    echo $a . '<hr>' . $b . '<hr>';
}

function f2($a, $b) {
    $a->setId(6);
    echo $a;
    $b = new Matricula();
    $b->setId(7);
    echo $b;
}

$v = 1;
$w = 2;
f($v, $w);

echo $v . '<hr>' . $w . '<hr>';

$x = new Matricula('a');
$y = new Matricula('b');

f2($x, $y);

echo $x;
echo $y;



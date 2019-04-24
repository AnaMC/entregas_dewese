<?php

//spl_autoload_register -> Le de cimos a php registra(funcionQueEncuentraLaClaseQueEstasBuscando)
spl_autoload_register(
  function ($clase) {
    $archivo = dirname(__FILE__) . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($archivo)) {
      require($archivo);
    }
});
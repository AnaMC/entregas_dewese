<?php

namespace izv\model;
use izv\data\Usuario;
use izv\tools\Util;
use izv\tools\Bootstrap;

class LoginModel extends Model {

    //Le indicamos que $entityManager tiene que ser de tipo Usuario y no un string o cualquier otra cosa.
    function crearUsuario (Usuario $usuario){
       
        //Al ser Doctrine necesitamos un try Catch
        $result = 1;
        try {
            // echo Util::varDump($usuario);
            // exit();
            $this->getEntityManager()->persist($usuario);
            $this->getEntityManager()->flush();
            return $usuario;    
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
}
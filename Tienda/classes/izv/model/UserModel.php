<?php

namespace izv\model;

use izv\data\Usuario;
use izv\tools\Util;

class UserModel extends Model {
    
    function registroUsuario ($usuario){
    //   echo Util::varDump($usuario);
    //   exit();
        //Al ser Doctrine necesitamos un try Catch
        $result = 1;
        try {
            $this->getEntityManager()->persist($usuario);
            $this->getEntityManager()->flush();
            // return $usuario;    
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
   
}
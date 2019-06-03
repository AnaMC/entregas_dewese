<?php

namespace izv\model;

use izv\data\Articulo;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

class ArticuloModel extends Model {
    
    function registroArticulo ($articulo){
    //   echo Util::varDump($articulo);
    //   exit();
        //Al ser Doctrine necesitamos un try Catch
        $result = 1;
        try {
            $this->getEntityManager()->persist($articulo);
            $this->getEntityManager()->flush();
            // return $articulo;    
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
}
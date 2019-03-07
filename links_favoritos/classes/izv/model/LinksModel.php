<?php

namespace izv\model;

use izv\data\Link;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

class LinksModel extends Model {
    
    function agregarCategoria($id, $categoria){
        $result = null;
        try {
            $usuario = $this->getEntityManager()->getReference('izv\data\Usario', ['id' => $id]);
            $categoria->setUsuario($usuario);
            $this->getEntityManager()->persist($categoria);
            $this->getEntityManager()->flush();  
            $result = $categoria;
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
}
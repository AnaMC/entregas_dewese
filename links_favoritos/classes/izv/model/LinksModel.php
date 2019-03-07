<?php

namespace izv\model;

use izv\data\Link;
use izv\data\Categoria;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

class LinksModel extends Model {
    
    function agregarCategoria($id, $categoria){
        $result = null;
        try {
            $usuario = $this->getEntityManager()->getReference('izv\data\Usuario', ['id' => $id]);
            $categoria->setUsuario($usuario);
            $this->getEntityManager()->persist($categoria);
            $this->getEntityManager()->flush();  
            return  $categoria;
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
    function getCatUser($id){
        $resultado = $this->getEntityManager()->createQuery('SELECT c FROM izv\data\Categoria c JOIN c.usuario u WHERE u.id = :id')
                ->setParameter('id', $id)
                ->getResult();
        
        return $resultado;
    }
    
    function insertarLink($usuario_id, $categoria, $link){
        $usuario = $this->getEntityManager()->getReference('izv\data\Usuario',  $usuario_id);
        $categoria = $this->getEntityManager()->getReference('izv\data\Categoria', $categoria);
        $link->setUsuario($usuario);
        $link->setCategoria($categoria);
        
        try {
            $this->getEntityManager()->persist($link);
            $this->getEntityManager()->flush();  
            return  $link;
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
     
   
}
<?php

namespace izv\model;

use izv\data\Link;
use izv\data\Categoria;
use izv\data\Usuario;
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
                                                //Limit -> nº de links por pagina
    function getListaLinks($id, $pagina = 1, $orden = 'c.categoria', $limit = 4 ){
     
        $dql = 'SELECT l, c  FROM izv\data\Link l join l.usuario u join l.categoria 
            c WHERE u.id = :id
            ORDER BY ' . $orden . ', c.categoria, l.href, l.comentario, l.id'; 
        
        $query = $this->getEntityManager()->createQuery($dql)->setParameter('id', $id);
     
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        
        $links = array();
        $resultado = array();
     
        foreach($paginator as $link){
            $categoria = $link->getCategoria()->getCategoria();

            $links['link'] = $link->getUnset(array('categoria','usuario'));
            $links['link']['categoria'] = $categoria;
            $resultado[] = $links;
            
        }
        return ['link' => $resultado, 'paginas' => $pagination->values()];
     
    }
    
    function delete($id) {
        $data = ['id' => $id];
        $item = $this->getEntityManager()->getRepository('\izv\data\Link')->findOneBy($data);
        $this->getEntityManager()->remove($item);
        $this->getEntityManager()->flush();
        return $item;
    }
    
    function getLink($clase, array $data = ['id' => '']) {
        
    }
}
<?php

namespace izv\model;

use izv\data\Usuario;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

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
    
    function getUsuario($id){
        $usuario = $this->getEntityManager()->getRepository('\izv\data\Usuario')->findOneBy(['id' => $id]);
        return $usuario;
    }   
    
    function getUsuarios(){
        $usuarios = array();
        $dql = 'select usu from izv\data\Usuario usu order by usu.alias';
        $query = $this->getEntityManager()->createQuery($dql);
        $result = $query->getResult();
        
        foreach($result as $usuario) {
            $usuarios[] = $usuario->getUnset(array('favoritos', 'pedidos'));
        }
        return $usuarios;
        //  varDump($usuarios);
        // exit();
    } 
    
    function borrarUsuario($id){
        $usuario_bd = $this->getUsuario($id);
        $this->getEntityManager()->remove($usuario_bd);
        $this->getEntityManager()->flush();
        return $usuario_bd; 
    }
    
    function editar($usuario){
        $id = $usuario->getId();
        $usuario_bd = $this->getUsuario($id);
        
        $usuario_bd->setNombre($usuario->getNombre());
        $usuario_bd->setApellidos($usuario->getApellidos());
        $usuario_bd->setAlias($usuario->getAlias());
        $usuario_bd->setCorreo($usuario->getCorreo());
        
        $this->getEntityManager()->persist($usuario_bd);
        $this->getEntityManager()->flush();
        return $usuario;
    }
    
    function getUsuariosPaginados($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = 'select usu from izv\data\Usuario usu order by usu.nombre';
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info' => $paginator, 'paginas' => $pagination->values());
    }
    
    
    
}
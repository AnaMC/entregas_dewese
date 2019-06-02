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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // function getUsuarios(){
    //     // $usuarios = $this->getEntityManager()->getRepository('\izv\data\Usuario')->findAll();
    //     // echo Util::varDump($usuarios);
    //     // return $usuarios;
    //      $dql = 'select usu from izv\data\Usuario usu order by usu.';
    //      $query = $this->getEntityManager()->createQuery($dql);
    //      $usuarios = array();
    //      foreach($query as $usuario) {
    //         // Recogemos cada usuario
    //         // getUnset -> nos quitamos los campos que no nos interesen del objeto, nos quitamos de problemas de relaciones
    //         $usuarios[] = $usuario->getUnset(array('favoritos'));
    //     }
    //     echo Util::varDump($query);
    //     exit();
    //     return  ['usuarios' => $usuarios];
    // }
    
        //  Paginacion y ordenacion
    // function getUsuarios($pagina = 1, $orden = 'nombre', $rrpp = 4) {
    //     if($pagina == null || !is_numeric($pagina)){
    //         $pagina = 1;
    //     }
        
    //     $dql = 'select usu from izv\data\Usuario usu order by usu.'. $orden .', usu.alias';
    //     $query = $this->getEntityManager()->createQuery($dql);
        
    //     $paginator = new Paginator($query);
    //     $paginator->getQuery()
    //         ->setFirstResult($rrpp * ($pagina - 1))
    //         ->setMaxResults($rrpp);
    //     // return $paginator;
    //     $pagination = new Pagination($paginator->count(), $pagina, $rrpp);
    //     $usuarios = array();
    //     foreach($paginator as $usuario) {
    //         // Recogemos cada usuario
    //         // getUnset -> nos quitamos los campos que no nos interesen del objeto, nos quitamos de problemas de relaciones
    //         // $usuarios[] = $usuario->getUnset(array('favorito','pedido'));
    //         $usuarios[] = $usuario;
    //     }
    //     // echo Util::varDump($usuarios);
    //     // exit();
    //     return ['usuarios' => $usuarios, 'paginas' => $pagination->values()];
    // }
   
}
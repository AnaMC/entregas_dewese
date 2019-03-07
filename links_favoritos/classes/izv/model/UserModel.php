<?php

namespace izv\model;

use izv\data\Usuario;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

class UserModel extends Model {
    
    function crearUsuario ( $usuario){
    //   echo Util::varDump($usuario);
    //   exit();
        //Al ser Doctrine necesitamos un try Catch
        $result = 1;
        try {
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

    function getUsuario($id_usuario){
        $usuario = $this->getEntityManager()->getRepository('\izv\data\Usuario')->findOneBy(['id' => $id_usuario]);
        return $usuario;
    }

    function login(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        return $manager->login($usuario->getCorreo(), $usuario->getClave());
    }

    function register(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        $r = $manager->add($usuario);
        if($r > 0) {
            $usuario->setId($r);
        }
        return $r;
    }
    
    function editarUsuario($usuario){
        $usuario_bd = $this->getUsuario($usuario->getId());
        
        $usuario_bd->setNombre($usuario->getNombre());
        $usuario_bd->setAlias($usuario->getAlias());
        $usuario_bd->setCorreo($usuario->getCorreo());
        $usuario_bd->setRol($usuario->getRol());
        
        $this->getEntityManager()->persist($usuario_bd);
        $this->getEntityManager()->flush();
        return $usuario;
    }
    
    function borrarUsuario($id){
        $usuario_bd = $this->getUsuario($id);
        $this->getEntityManager()->remove($usuario_bd);
        $this->getEntityManager()->flush();
        return $usuario_bd;
    }
    
    //Contar número de usuarios registrados
     function usuarioCount() {
            $dql = 'select count(u) from izv\data\Usuario u';
                //getResults() -> Método de EntityManager();
            $resultado = $this->getEntityManager()->createQuery($dql)->getResult();
            echo Util::varDump( $resultado);
            exit();
            //RECORRER CON FOREACH Y MOSTRAR PRIMER RESULTADO
        return $usuarios;
    }
    
    //Paginacion y ordenacion
    function getUsuarios($pagina = 1, $orden = 'nombre', $rrpp = 4) {
        if($pagina == null || !is_numeric($pagina)){
            $pagina = 1;
        }
        
        $dql = 'select usu from izv\data\Usuario usu order by usu.'. $orden .', usu.alias';
        $query = $this->getEntityManager()->createQuery($dql);
        
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($rrpp * ($pagina - 1))
            ->setMaxResults($rrpp);
        // return $paginator;
        $pagination = new Pagination($paginator->count(), $pagina, $rrpp);
        $usuarios = array();
        foreach($paginator as $usuario) {
            // Recogemos cada usuario
            // getUnset -> nos quitamos los campos que no nos interesen del objeto, nos quitamos de problemas de relaciones
            $usuarios[] = $usuario->getUnset(array('links','categorias'));
        }
        // echo Util::varDump($usuarios);
        // exit();
        return ['usuarios' => $usuarios, 'paginas' => $pagination->values()];
    }
    
}
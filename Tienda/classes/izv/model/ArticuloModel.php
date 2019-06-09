<?php

namespace izv\model;

use izv\data\Articulo;
use izv\tools\Util;
use izv\data\Pedido;
use izv\data\Detalle;
use izv\data\Usuario;
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
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
    function getArticulosPaginados($pagina = 1, $rpp = 8) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = 'select art from izv\data\Articulo art order by art.nombre';
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info' => $paginator, 'paginas' => $pagination->values());
    }
    
    function getArticulo($id){
        $articulo = $this->getEntityManager()->getRepository('\izv\data\Articulo')->findOneBy(['id' => $id]);
        return $articulo;
    }   
    
     function borrarArticulo($id){
        $articulo_bd = $this->getArticulo($id);
        $this->getEntityManager()->remove($articulo_bd);
        $this->getEntityManager()->flush();
        // return $articulo_bd; 
    }
    
    function editar($articulo){
        $id = $articulo->getId();
        $articulo_bd = $this->getArticulo($id);
        
         $articulo_bd->setNombre($articulo->getNombre());
         $articulo_bd->setPrecio($articulo->getPrecio());
         $articulo_bd->setCantidad($articulo->getCantidad());
         $articulo_bd->setTallaDesde($articulo->getTallaDesde());
         $articulo_bd->setTallaHasta($articulo->getTallaHasta());
         $articulo_bd->setDescripcion($articulo->getDescripcion());
         $articulo_bd->setTipo($articulo->getTipo());
        
        $this->getEntityManager()->persist( $articulo_bd);
        $this->getEntityManager()->flush();
        return $articulo;
    }
    
     function getLenceriaPaginada($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='sujetadores' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info' => $paginator, 'paginas' => $pagination->values());
    }
    
    function comprarArticulo($articuloId, $usuarioId, $cantidad=1, $formaPago='Paypal'){
        $gestor = $this->getEntityManager();
        
        $pedido = new Pedido();
        $detalle = new Detalle();
        
        $usuario = $gestor->getReference('izv\data\Usuario', ['id' => $usuarioId]);
        $pedido->setUsuario($usuario);
        $pedido->setFormaPago($formaPago);
        $gestor->persist($pedido);
        
        $articulo = $this->getArticulo($articuloId);
        $total = $articulo->getPrecio() * $cantidad;
        
        $detalle->setPedido($pedido);
        $detalle->setPrecio($total);
        $detalle->setCantidad($cantidad);
        $detalle->setArticulo($articulo);
        
        $gestor->persist($detalle);
        $gestor->flush();
        
        return count($pedido->getDetalles);
    }
    
}
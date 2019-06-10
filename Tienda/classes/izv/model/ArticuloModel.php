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
        $articulo_bd = $this->getArticulo($articulo->getId());
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
        return array('info_len' => $paginator, 'paginas_len' => $pagination->values());
    }
    
    function comprarArticulo($articuloId, $usuarioId, $cantidad = 1, $formaPago = 'Paypal'){
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
    
    function getBraguitaPaginado($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='braguita' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info_br' => $paginator, 'paginas_br' => $pagination->values());
    }
    
    function getBodyPaginado($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='body' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info_body' => $paginator, 'paginas_body' => $pagination->values());
    }
    
    function getPijamaPaginado($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='pijama' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info_cor' => $paginator, 'paginas_cor' => $pagination->values());
    } 
    
    function getHomewPaginado($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='homewear' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info_homew' => $paginator, 'paginas_homew' => $pagination->values());
    } 
    
    function getCamiPaginado($pagina = 1, $rpp = 4) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = "select art from izv\data\Articulo art where art.tipo='camison' order by art.nombre";
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info_cami' => $paginator, 'paginas_cami' => $pagination->values());
    } 
    
}
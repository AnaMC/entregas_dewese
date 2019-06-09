<?php

namespace izv\model;

use izv\data\Articulo;
use izv\data\Detalle;
use izv\data\Pedido;
use izv\tools\Util;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Pagination;

class CompraModel extends Model {
    
    function registroPedido ($pedido){
        $result = 1;
        try {
            $this->getEntityManager()->persist($pedido);
            $this->getEntityManager()->flush();
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        } catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
    function getPedidosPaginados($pagina = 1, $id, $orden = 'fechaPedido', $limit = 4) {
        $dql = 'SELECT p  FROM izv\data\Pedido p join p.usuario u WHERE u.id = :id order by p.formaPago';  
        $query = $this->getEntityManager()->createQuery($dql)
        ->setParameter('id',$id );
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        $pedidos = array();
        foreach($paginator as $pedido) {
            $pedidos[] = $pedido->getUnset(array('usuario','detalles'));
        }
        // var_dump($pedidos);
        // exit;
        return ['pedidos' => $pedidos, 'paginas' => $pagination->values()];    
    }    
    
    function getPedidosPaginadosUsuarios($pagina = 1, $orden = 'fechaPedido', $limit = 10) {
        $dql = 'SELECT p  FROM izv\data\Pedido p join p.usuario u order by p.formaPago';  
        $query = $this->getEntityManager()->createQuery($dql);
        // ->setParameter('id',$id );
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        $pedidos = array();
        foreach($paginator as $pedido) {
            $pedidos[] = $pedido->getUnset(array('usuario','detalles'));
        }
        // var_dump($pedidos);
        // exit;
        return ['pedidos' => $pedidos, 'paginas' => $pagination->values()];    
    }
    
    function getPedio($id){
        $pedido = $this->getEntityManager()->getRepository('\izv\data\Pedido')->findOneBy(['id' => $id]);
        return $pedido;
    }   

    function borrarPedido($id){
        $pedido_bd = $this->getPedido($id);
        $this->getEntityManager()->remove($pedido_bd);
        $this->getEntityManager()->flush();
        // return $articulo_bd; 
    }
    
    function getArticulosPaginados($pagina = 1, $rpp = 4) {
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
    
}
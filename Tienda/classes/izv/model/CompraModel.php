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
    
    function getPedidosPaginados($pagina = 1, $rpp = 3) {
        $gestor = $this->getEntityManager();
        // $gestor = $this->getManager();
        $dql = 'select det from izv\data\Detalle det order by det.precio';
        $query = $gestor->createQuery($dql);
        $paginator = new Paginator($query); 
        $total = $paginator->count();
        $pagination = new Pagination($total, $pagina, $rpp); 
        $paginator->getQuery()
            ->setFirstResult($pagination->offset())
            ->setMaxResults($pagination->rpp());
        return array('info' => $paginator, 'paginas' => $pagination->values());
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
    
}
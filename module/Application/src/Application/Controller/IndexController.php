<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;
use Zend\Paginator\Paginator;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                // Creamos una DQL, es parecido a una SQL pero nos referimos a las 
                // entidades del modelo.
                $queryBuilder = $em->createQueryBuilder()
                    // le pido todos los datos de la entrada
                    ->select('e')
                    // aca definimos el alias "e"
                    ->from('Application\Entity\Entrada', 'e')
                    ->orderBy('e.id', 'DESC')
                    // hacemos el limit
                    ->setMaxResults(3);
                // Le pedimos el resultado a la query generada por el builder
                $entradas = $queryBuilder->getQuery()->getResult();
                return new ViewModel(['entradas' => $entradas]);
    }

    public function acercaAction()
    {
    }

    public function verEntradaAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $entrada = $em->find('Application\Entity\Entrada', $this->params('id'));
                return new ViewModel(['entrada' => $entrada]);
    }

    public function archivoAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        // Creamos una query de la misma manera que lo hicimos para crear la query
        $query = $em->createQueryBuilder()
            ->select('e')
            ->from('Application\Entity\Entrada', 'e')
            ->orderBy('e.id', 'DESC')
            ->getQuery();
        // Se la pasamos al paginador del ORM 
        $ormPaginador = new OrmPaginator($query);
        // Doctrine nos provee un adaptador del paginador para ZF
        $adaptador = new DoctrineAdapter($ormPaginador);
        // Creamos un paginador de ZF 
        $zfPaginador = new Paginator($adaptador);
        // Le pasamos como parámetro el número de página actual.
        // Lo obtenemos desde el segmento.
        $zfPaginador->setCurrentPageNumber($this->params('pagina', 1))
        // Luego le pasamos la cantidad máxima de items por página
                    ->setItemCountPerPage(5);        
        return new ViewModel(['paginador' => $zfPaginador]);
    }


}


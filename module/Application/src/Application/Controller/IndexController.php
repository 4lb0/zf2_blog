<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
        return new ViewModel();
    }


}


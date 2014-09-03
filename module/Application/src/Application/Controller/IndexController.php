<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
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


}


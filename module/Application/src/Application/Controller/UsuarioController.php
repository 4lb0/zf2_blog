<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{

    public function indexAction()
    {

$identity = $authResult->getIdentity();
var_dump ($authResult->isValid(), $identity); die;
        return new ViewModel();
    }

    public function loginAction()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($authService->getIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        if ($this->getRequest()->isPost()) {
            $adapter = $authService->getAdapter();
            $adapter->setIdentityValue('admin');
            $adapter->setCredentialValue('admin');
            $authResult = $authService->authenticate();
        }
        return new ViewModel();
    }


}


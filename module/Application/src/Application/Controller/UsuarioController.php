<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\LoginForm;

class UsuarioController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function loginAction()
    {
        $form = new LoginForm('login');
        return new ViewModel(['form' => $form]);
    }


}


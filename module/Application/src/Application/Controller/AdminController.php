<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\EntradaForm;

class AdminController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function nuevoAction()
    {
        $form = new EntradaForm();
        return new ViewModel(['form' => $form]);
    }


}


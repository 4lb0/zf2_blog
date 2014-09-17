<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Form\EntradaForm;
use Application\Entity\Entrada;
use Zend\Mvc\MvcEvent;

class AdminController extends AbstractActionController
{
    public function __construct()
    {
        $events = $this->getEventManager();
        $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'checkLogin'));
    }

    public function checkLogin()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if (!$authService->getIdentity()) {
            // return $this->redirect()->toRoute('login');
        }
    }

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        // Le pedimos al EntityManager que nos de el repositorio de entrada
        // El repositorio es el objeto al cual le pedimos los datos que estan 
        // en la base
        $repositorio = $em->getRepository('Application\Entity\Entrada');
        // Para este primer caso obtenemos todas las entradas sin ningún criterio
        // u orden particular
        $entradas = $repositorio->findAll();
        return new ViewModel(['entradas' => $entradas]);
    }

    public function nuevoAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $entrada = new Entrada();
        $form = new EntradaForm($em);
        $form->bind($entrada);
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $em->persist($entrada);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Entrada creada correctamente.');
                return $this->redirect()->toRoute('admin');
            }
        }
        return new ViewModel(['form' => $form]);
    }

    public function eliminarAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $entrada = $em->find('Application\Entity\Entrada', $this->params('id'));
        $mensaje = sprintf("Entrada '%s' eliminada correctamente", $entrada->getTitulo());
        $em->remove($entrada);
        $em->flush();
//        if ($this->request->isXmlHttpRequest()) {
            return new JsonModel([
                'mensaje' => $mensaje,
                'eliminado' => true,
            ]);
  //      }
        $this->flashMessenger()->addSuccessMessage($mensaje);
        return $this->redirect()->toRoute('admin');
    }

}


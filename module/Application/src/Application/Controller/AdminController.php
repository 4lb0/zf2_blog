<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\EntradaForm;
use Application\Entity\Entrada;

class AdminController extends AbstractActionController
{

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
        $form = new EntradaForm();
        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            // por ahora seteamos los datos manualmente
            $entrada = new Entrada();
            $entrada->setTitulo($data->titulo); 
            $entrada->setContenido($data->contenido);
                        
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            // le decimos al EntityManager que vamos a guardar el objeto entrada
            $em->persist($entrada);
            // aca ejecuta en la base todos los cambios que le pedímos
            $em->flush();

            // redirigimos al listado
            return $this->redirect()->toRoute('admin');
        }
        return new ViewModel(['form' => $form]);
    }


}


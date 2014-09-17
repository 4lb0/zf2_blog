<?php

namespace Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class EntradaForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('entrada-form');

        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));
        $entradaFieldset = new EntradaFieldset($objectManager);
        $entradaFieldset->setUseAsBaseFieldset(true);
        $this->add($entradaFieldset);
        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Guardar',
                'id' => 'submit',
            ],
        ]);
    }
}

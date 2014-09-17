<?php

namespace Application\Form;

use Application\Entity\Entrada;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EntradaFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('entrada');

        $this->setHydrator(new DoctrineEntity($objectManager, 'Application\Entity\Entrada'))
             ->setObject(new Entrada());

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'titulo',
            'options' => [
                'label' => 'Titulo:',
            ],
        ));
        $this->add([
            'name' => 'contenido',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => [
                'label' => 'Contenido:',
            ],
        ]);
        
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'categoria',
            'options' => array(
                'object_manager' => $objectManager,
                'target_class'   => 'Application\Entity\Categoria',
                'property'       => 'nombre',
                'label' => 'Categoria:',
            ),
        ]);

        $tagFieldset = new TagFieldset($objectManager);
        $this->add(array(
            'type'    => 'Zend\Form\Element\Collection',
            'name'    => 'tags',
            'options' => array(
                'count'          => 3,
                'target_element' => $tagFieldset
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'titulo' => array(
                'required' => true
            ),
        );
    }
}
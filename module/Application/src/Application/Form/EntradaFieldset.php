<?php

namespace Application\Form;

use Application\Entity\Entrada;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class EntradaFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('entrada');

        $this->setHydrator(new DoctrineHydrator($objectManager))
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

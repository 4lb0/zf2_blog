<?php

namespace Application\Form;

use Zend\Form\Form;

class EntradaForm extends Form
{

    public function __construct()
    {
        parent::__construct('entrada');

        $this->add([
            'name' => 'titulo',
            'type' => 'Text',
            'options' => [
                'label' => 'Título:',
            ],
        ]);
        $this->add([
            'name' => 'contenido',
            'type' => 'Textarea',
            'options' => [
                'label' => 'Contenido:',
            ],
        ]);
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

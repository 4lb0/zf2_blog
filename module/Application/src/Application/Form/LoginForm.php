<?php

namespace Application\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->add([
            'name' => 'email',
            'type' => 'Text',
            'options' => [
                'label' => 'Usuario:',
            ],
        ]);
        $this->add([
            'name' => 'password',
            'type' => 'Password',
            'options' => [
                'label' => 'Contraseña:',
            ]
        ]);
        // Este campo es para prevenir un ataque de CSRF
        // mas info en español http://es.wikipedia.org/wiki/Cross_Site_Request_Forgery
        // y en inglés https://www.owasp.org/index.php/Cross-Site_Request_Forgery_%28CSRF%29
        $this->add([
            'name' => 'login_csrf',
            'type' => 'Csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 60 * 10,
                ],
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Iniciar Sesión',
            ] 
        ]);
    }
}

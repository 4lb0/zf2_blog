<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    // Establecemos que todas las conexiones sean UTF-8
                    'driverOptions' => array(1002 => "SET NAMES 'UTF8'"),
                )
            )
        )
    ),
);

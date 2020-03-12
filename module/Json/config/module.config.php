<?php
namespace Json;

return array(
    'controllers' => array(
        'invokables' => array(
            //'Json\Controller\Package' => 'Json\Controller\PackageController',
        ),
        'factories' => array(
            'Json\Controller\Package' => 'Json\Controller\Factory\PackageControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'packagejson' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/package-json[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Json\Controller',
                        'controller'    => 'Package',
                        //'action'        => 'index',
                    ),
                ),
              
                
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Json' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'configuration' => array(
            'orm_default' => array(
                'generate_proxies' => true
            )
        ),
    
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);

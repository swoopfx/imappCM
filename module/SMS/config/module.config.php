<?php
namespace SMS;

return array(
    'controllers' => array(
       
        'factories' => array(
            'SMS\Controller\Index' => 'SMS\Controller\Factory\IndexControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            's-m-s' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/sms',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'SMS\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'SMS' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'sms-smsunit-fielset-snipet'=>__DIR__ . '/../view/sms/partial/smsunit-snipet.phtml',
        ),
    ),
    
    'doctrine' => array(
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
    ),
    
    'service_manager' => array(
        'factories' => array(
            'SMS\Service\SMSService'=>'SMS\Service\Factory\SMSServiceFactory'
        ),
    ),
    'form_elements'=>array(
        'factories'=>array(
            'SMS\Form\Fieldset\SMSUnitFieldset'=>'SMS\Form\Fieldset\Factory\SMSUnitFieldsetFactory',
            'SMS\Form\BuySmsForm'=>'SMS\Form\Factory\BuySmsFormFactory'
        )
    ),
);

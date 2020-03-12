<?php
namespace BrokersTool;

return array(
    'controllers' => array(
        'invokables' => array(
            // 'BrokersTool\Controller\BrokerTool' => 'BrokersTool\Controller\BrokerToolController'
        ),
        'factories' => array(
            'BrokersTool\Controller\BrokerTool' => 'BrokersTool\Controller\Factory\BrokerToolControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'brokers-tool' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/broker-tool',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'BrokersTool\Controller',
                        'controller' => 'BrokerTool',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action[/:id]]',
                            'constraints' => array(
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'assign-broker' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/broker-tools/assign-child/:customerId',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'customerId' => '[0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'BrokersTool\Controller',
                        'controller' => 'BrokerTool',
                        'action' => 'assignBroker'
                    )
                ),
                'may_terminate' => true
            
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'BrokersTool' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            "broker-tool-add-staff-fieldset-snippet"=>__DIR__ . '/../view/partials/add-staff-fieldset-snippet.phtml',
            
            'broker-tool-add-staff-snipet' => __DIR__ . '/../view/brokers-tool/partials/broker-tool-add-staff-snipet.phtml',
            'registered-staff-snipet' => __DIR__ . '/../view/brokers-tool/partials/registered-staff-snipet.phtml',
            'email-broker-tool-customer-register' => __DIR__ . '/../view/mails/broker-tool-customer-register.phtml',
            'broker-tool-flutterwave-snipet' => __DIR__ . '/../view/brokers-tool/partials/broker-tool-flutterwave-snipet.phtml',
            'broker-tool-assign-broker-form-snippet' => __DIR__ . '/../view/brokers-tool/partials/broker-tool-assign-broker-form-snippet.phtml',
            // Modal
            "brokertool-upload-logo-snippet"=> __DIR__ . '/../view/partials/modal/upload-logo-snippet.phtml',
            "brokers-tool-change-phone-number-form"=> __DIR__ . '/../view/partials/modal/brokers-tool-change-phone-number-form.phtml',
            "brokers-tool-change-email-form"=> __DIR__ . '/../view/partials/modal/brokers-tool-change-email-form.phtml',
            "brokers-tool-staff-details-snippet"=> __DIR__ . '/../view/partials/modal/broker-tools-staff-details-snipet.phtml',
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'BrokersTool\Service\BrokerToolService' => 'BrokersTool\Service\Factory\BrokerToolServiceFactory'
        )
    ),
    
    'form_elements' => array(
        'factories' => array(
            "BrokersTool\Form\Fieldset\StaffEmailFieldset"=>"BrokersTool\Form\Fieldset\Factory\StaffEmailFieldsetFactory",
            "BrokersTool\Form\Fieldset\StaffPhoneNumberFieldset"=>"BrokersTool\Form\Fieldset\Factory\StaffPhoneNumberFieldsetFactory",
            'BrokersTool\Form\Fieldset\BrokerChildProfileFieldset' => 'BrokersTool\Form\Fieldset\Factory\BrokerChildProfileFieldsetFactory',
            'BrokersTool\Form\Fieldset\CustomerMessageFieldset' => 'BrokersTool\Form\Fieldset\Factory\CustomerMessageFeildsetFactory',
            'BrokersTool\Form\Fieldset\AssignBrokerFieldset' => 'BrokersTool\Form\Fieldset\Factory\AssignBrokerFieldsetFactory',
            "BrokersTool\Form\AssignBrokerForm" => 'BrokersTool\Form\Factory\AssignBrokerFormFactory',
            'BrokersTool\Form\AddStaffForm' => 'BrokersTool\Form\Factory\AddStaffFormFactory',
            'BrokersTool\Form\BrokerChildProfileForm' => 'BrokersTool\Form\Factory\BrokerChildProfileFormFactory',
            'BrokersTool\Form\Fieldset\BrokerChildFieldset' => 'BrokersTool\Form\Fieldset\Factory\BrokerChildFieldsetFactory',
            "BrokersTool\Form\StaffPhoneNumberForm"=>"BrokersTool\Form\Factory\StaffPhoneNumberFormFactory",
            "BrokersTool\Form\StaffEmailForm"=>"BrokersTool\Form\Factory\StaffEMailFormFactory"
        )
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
    )
);

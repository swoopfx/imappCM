<?php

namespace  Messages;
return array(
    'controllers' => array(
        'invokables' => array(
            //'Messages\Controller\Messages' => 'Messages\Controller\MessagesController',
        ),
        'factories' => array(
            'Messages\Controller\Messages' => 'Messages\Controller\Factory\MessagesControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'messages' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/messages',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Messages\Controller',
                        'controller'    => 'Messages',
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
                               // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
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
            'Messages' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            "message-form-snippet"=>__DIR__ . '/../view/partial/message-form-snipet.phtml',
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
    ),
    "form_elements"=>array(
        "factories"=>array(
            "Messages\Form\Fieldset\MessageEnteredFieldset"=>"Messages\Form\Fieldset\Factory\MessageEnteredFieldsetFactory",
            "Messages\Form\MessageForm"=>"Messages\Form\Factory\MessageFormFactory"
        ),
    ),
    
    'service_manager' => array(
        'factories' => array(
            "Messages\Service\MessageService"=>"Messages\Service\Factory\MessageServiceFactory"
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            "brokerMessageCustomerHelper"=>"Messages\View\Helper\BrokerMessageCustomerHelper",
            "brokerMessageSnippet"=>"Messages\View\Helper\BrokerMessageSnippet",
            "brokerMessageCustomerPackageHelper"=>"Messages\View\Helper\BrokerMessageCustomerPackageHelper",
            "brokerMessageOfferHelper"=>"Messages\View\Helper\BrokerMessageOfferHelper",
            "brokerMessageProposalHelper"=>"Messages\View\Helper\BrokerMessageProposalHelper",
            "customerMessageOfferHelper"=>"Messages\View\Helper\CutomerMessageOfferHelper",
            "customerMessageProposalHelper"=>"Messages\View\Helper\CustomerMessageProposalHelper",
            "customerMessagesPackagesHelper"=>"Messages\View\Helper\CustomerMessagePackageHelper"
        ),
    ),
);

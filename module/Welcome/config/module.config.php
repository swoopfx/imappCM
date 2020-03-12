<?php
namespace Welcome;

return array(
    'controllers' => array(
        'invokables' => array(
            'Welcome\Controller\Index' => 'Welcome\Controller\IndexController',
            'Welcome\Controller\Manager' => 'Welcome\Controller\ManagerController'
        )
        // 'Welcome\Controller\Broker' => 'Welcome\Controller\BrokerController',
        // 'Welcome\Controller\Agent' => 'Welcome\Controller\AgentController',
        ,
        'factories' => array(
            'Welcome\Controller\Agent' => 'Welcome\Controller\Factory\AgentControllerFactory',
            'Welcome\Controller\Broker' => 'Welcome\Controller\Factory\BrokerControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            
            'welcome' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Welcome\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                
            ),
            
            'permissionerror' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/permissionerror',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Welcome\Controller',
                        'controller' => 'Index',
                        'action' => 'permissionerror'
                    )
                ),
                'may_terminate' => true,
            ),
            
            'manager' => array(
                'type' => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/manager[/:action]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Welcome\Controller',
                        'controller' => 'Manager',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            )
            ,
            
            'agent_welcome' => array(
                'type' => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/agent-welcome[/:action]',
                    'constraints' => array(
                        
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Welcome\Controller',
                        'controller' => 'Agent',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            )
            ,
            
            'broker_welcome' => array(
                'type' => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/broker-welcome[/:action]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Welcome\Controller',
                        'controller' => 'Broker',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            )
            
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Welcome' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            "welcome/welcome/layout"=>__DIR__ . '/../view/layout/index.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'displayPriceCondition' => 'Welcome\View\Helper\PackageViewHelper'
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
)
;

<?php
namespace Home;

return array(
    'controllers' => array(
        
        'factories' => array(
            'Home\Controller\Index' => 'Home\Controller\Factory\IndexControllerFactory',
            'Home\Controller\Activate' => 'Home\Controller\Factory\ActivateControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            
            'dashboard' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Index',
                        'action' => 'dashboard'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'activation' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/activation',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Activate',
                        'action' => 'vate'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'nonhome' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/nonhome[/:action[/:id[/:i]]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'i' => '[0-9]'
                    ),
                ),
                'may_terminate' => true,
//                 'child_routes' => array(
//                     'default' => array(
//                         'type' => 'Segment',
//                         'options' => array(
//                             'route' => '[/:action[/:id]]',
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'id' => '[a-zA-Z0-9_-]*'
//                             ),
//                             'defaults' => array()
//                         )
//                     )
//                 )
            ),
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Home' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'dashboard-my-customer-snipet'=> __DIR__ . '/../view/partials/dashboard-my-customer-snipet.phtml',
            'dashboard-my-expired-invoice-snipet'=> __DIR__ . '/../view/partials/dashboard-my-expired-invoice-snipet.phtml',
            'dashboard-my-proposal-snipet'=> __DIR__ . '/../view/partials/dashboard-my-proposal-snipet.phtml',
            'dashboard-unsettled-claims-snipet'=> __DIR__ . '/../view/partials/dashboard-unnsettled-claims-snipet.phtml',
            'dashboard-active-offer-snipet'=> __DIR__ . '/../view/partials/dashboard-active-offer-snipet.phtml',
            'dashboard-upcoming-renwal'=> __DIR__ . '/../view/partials/dashboard-upcoming-renewal.phtml',
            "dashboard-going-mobile"=> __DIR__ . '/../view/partials/dashboard-going-mobile.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'dashboard_broker_account_helper'=>'Home\View\Helper\BrokerAccountHelper',
            'dashboard_broker_sub_helper'=>'Home\View\Helper\BrokerSubcriptionHelper',
            'dashboard_stats_helper'=>'Home\View\Helper\DsahboardStatsHelper',
            'dashboard_info_ducker_helper'=>'Home\View\Helper\InfoDuckerHelper',
            'dashboard_isnotification_helper'=>'Home\View\Helper\IsNotificationHeade',
            'dashboard_subscription_expire_alert'=>'Home\View\Helper\SubscriptionExpireNotificationHelper',
            "dashboard_sms_expire_notify"=>"Home\View\Helper\SMSExpireNotification"
        ),
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Home\Service\HomeService'=>'Home\Service\Factory\HomeServiceFactory'
        ),
    ),
    "form_elements"=>array(
        "factories"=>array(
            "Home\Form\ActivationForm"=>"Home\Form\Factory\ActivationFormFactory",
            "Home\Form\ActivateLoginForm"=>"Home\Form\Factory\ActivateLoginFormFactory",
            "Home\Form\BrokerProfileForm"=>"Home\Form\Factory\BrokerProfileFormFactory",
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
    ),
);

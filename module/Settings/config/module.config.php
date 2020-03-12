<?php
namespace Settings;

return array(
    'controllers' => array(
//         
        'factories' => array(
            'Settings\Controller\Settings'=>'Settings\Controller\Factory\SettingsControllerFactory',
            'Settings\Controller\Account'=>'Settings\Controller\Factory\AccountControllerFactory'
        ),
        
    ),
    'router' => array(
        'routes' => array(
            'settings' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/settings',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Settings\Controller',
                        'controller' => 'Settings',
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
                            'route' => '[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'sub_account' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/account',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Settings\Controller',
                        'controller' => 'Account',
                        'action' => 'renew-account'
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
                                //'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Settings' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'account-package-display-snipet'=>__DIR__ . '/../view/settings/account/partial/account-package-display-snipet.phtml',
            'settings-navigation'=>__DIR__ . '/../view/partial/setting-navigation-snipet.phtml',
            'setting-account-list-of-account'=>__DIR__ . '/../view/partial/setting-account-list-of-account.phtml',
            'setting-account-account-name-form-snipet'=>__DIR__ . '/../view/partial/settings-account-account-name-form-snipet.phtml',
            
        ),
    ),
    'form_elements'=>array(
        'factories'=>array(
            "Settings\Form\Fieldset\GeneralPolicyCoverTermedValueFieldset"=>"Settings\Form\Fieldset\Factory\GeneralPocilyCoverTermedFieldsetFactory",
            'Settings\Form\BrokerBankAccountForm'=>'Settings\Form\Factory\BrokerBankAccountFormFactory',
            'Settings\Form\RenewAccountForm'=>'Settings\Form\Factory\RenewAccountFormFactory',
            "Settings\Form\AccountNameRequestForm"=>"Settings\Form\Factory\AccountNameRequestFormFactory"
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
    )
);

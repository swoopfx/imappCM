<?php
namespace Users;

return array(
    'controllers' => array(
        'invokables' => array()
        // 'Users\Controller\Broker' => 'Users\Controller\BrokerController'
        ,
        
        'factories' => array(
            'Users\Controller\Agent' => 'Users\Controller\Factory\AgentControllerFactory',
            'Users\Controller\Broker' => 'Users\Controller\Factory\BrokerControllerFactory',
            'Users\Controller\Ind' => 'Users\Controller\Factory\IndControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            
            'user_broker' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/user/broker[/:action[/:id]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Broker',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            ),
            
            'user_agent' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/user/agent[/:action[/:id][/:ses]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Agent',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            ),
            
            'user_ind' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/user/ind[/:action[/:id][/:ses]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    // 'id' => '[0-9]*',
                    // 'ses'=>'[a-zA-Z][a-zA-Z0-9_-]*'
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Ind',
                        'action' => 'index'
                    )
                )
            ),
            
            'user_org' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/user/org[/:action[/:id][/:ses]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                        'ses' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Org',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'display_exceptions' => true,
        'strategies'=>array(
            'ViewJsonStrategy'
        ),
        'template_path_stack' => array(
            'Users' => __DIR__ . '/../view'
        ),
        
        'template_map' => array(
            'user-snipet' => __DIR__ . '/../view/partials/user-snipet.phtml',
            'user-register-snipet' => __DIR__ . '/../view/partials/register-snipet.phtml',
            'setup-info-snipet' => __DIR__ . '/../view/partials/setup-info-snipet.phtml',
            'broker-setup-data-snipet' => __DIR__ . '/../view/partials/broker-setup-data-snipet.phtml',
            'broker-address-snipet' => __DIR__ . '/../view/partials/broker-address-snipet.phtml',
            'broker-bank-account-snipet' => __DIR__ . '/../view/partials/broker-bank-account-snipet.phtml',
            'broker-telephone-snipet' => __DIR__ . '/../view/partials/broker-telephone-snipet.phtml',
            'broker-package-select-snipet' => __DIR__ . '/../view/partials/broker-package/broker-package-select.phtml',
            'broker-info-sub-snipet'=> __DIR__ . '/../view/partials/broker-info-subscription-snipet.phtml',
            'broker-info-invoice-snipet'=> __DIR__ . '/../view/partials/broker-info-invoice-snipet.phtml',
            'users-setup-invoice-snipet'=>__DIR__.'/../view/partials/setup-invoice-snipet.phtml',
            "broker-ceo-form-snippet"=>__DIR__.'/../view/partials/broker-ceo-form-snippet.phtml',
            "broker-ceo-info-snippet"=>__DIR__.'/../view/partials/broker-ceo-info-snippet.phtml',
            "broker-child-form-snippet"=>__DIR__.'/../view/partials/broker-child-form-snippet.phtml',
            
            // Begin Modal
            "user-broker-profile-form"=>__DIR__.'/../view/partials/modal/user-broker-profile-fieldset.phtml',
        )
        
    ),
    
    'service_manager' => array(
        'factories' => array(
            'users_agent_register_fieldset_factory' => 'Users\Form\Fieldset\Factory\AgentRegsiterFactory',
            'users_service_main' => 'Users\Service\Factory\UsersFactory',
            'Users\Service\BrokerSetupService'=>'Users\Service\Factory\BrokerSetupFactory',
            'Users\Service\SetupService'=>'Users\Service\Factory\SetUpFactory',
            'Users\Service\BrokerGeneralService'=>'Users\Service\Factory\BrokerGeneralServiceFactory'
        )
    ),
   
    
    'form_elements' => array(
        'factories' => array(
            'Users\Form\Fieldset\AgentSetupDataFieldset' => 'Users\Form\Fieldset\Factory\AgentSetupDataFieldsetFactory',
            
            'Users\Form\Fieldset\UContactFieldset' => 'Users\Form\Fieldset\Factory\UContactFieldsetFactroy',
            'Users\Form\Fieldset\UserProfileFieldset' => 'Users\Form\Fieldset\Factory\UserProfileFieldsetFactory',
            'Users\Form\Fieldset\AgentAddressFieldset' => 'Users\Form\Fieldset\Factory\AgentAddressFieldsetFactory',
            'Users\Form\Fieldset\AgentTelephoneFieldset' => 'Users\Form\Fieldset\Factory\AgentTelephoneFieldsetFactory',
            'Users\Form\Fieldset\InsuranceAgentFieldset' => 'Users\Form\Fieldset\Factory\InsuranceAgentFieldsetFactory',
            'Users\Form\Fieldset\AgentBankAccountFieldset' => 'Users\Form\Fieldset\Factory\AgentBankAccountFieldsetFactory',
            'Users\Form\Fieldset\BrokerSetUpDataFieldset' => 'Users\Form\Fieldset\Factory\BrokerSetUpDataFieldsetFactroy',
            "Users\Form\Fieldset\BrokerSetupPackagePremiumFieldset"=>"Users\Form\Fieldset\Factory\BrokerSetupPackagePremiumFieldsetFactory",
            'Users\Form\Fieldset\BrokerAddressFieldset' => 'Users\Form\Fieldset\Factory\BrokerAddressFieldsetFactory',
             "Users\Form\Fieldset\BrokerCeoFieldset"=>"Users\Form\Fieldset\Factory\BrokerCeoFieldsetFactory",
            'Users\Form\Fieldset\BrokerTelephoneFieldset' => 'Users\Form\Fieldset\Factory\BrokerTelephoneFieldsetFactory',
            'Users\Form\Fieldset\BrokerBankAccountFieldset' => 'Users\Form\Fieldset\Factory\BrokerBankAccountFieldsetFactory',
            'Users\Form\Fieldset\BrokerSetUpDataFieldset' => 'Users\Form\Fieldset\Factory\BrokerSetUpDataFieldsetFactroy',
            'Users\Form\Fieldset\BrokerPackageFieldset' => 'Users\Form\Fieldset\Factory\BrokerSetupPackageFieldsetFactory',
            'Users\Form\Fieldset\BrokerLogoUploadFieldset'=>'Users\Form\Fieldset\Factory\BrokerLogoUploadFieldsetFactory',
            'Users\Form\BrokerLogoUploadForm'=>'Users\Form\Factory\BrokerUploadFormFactory',
            "Users\Form\BrokerSetupPackagePremiumForm"=>" Users\Form\Factory\BrokerSetupPackagePremiumFormFactory",
            'Users\Form\AgentForm' => 'Users\Form\Factory\AgentRegisterFormFactory',
            'Users\Form\AgentSetupForm' => 'Users\Form\Factory\AgentSetupFormFactory',
            'Users\Form\IndForm' => 'Users\Form\Factory\IndFormFactory',
            'Users\Form\BrokerRegsiterForm' => 'Users\Form\Factory\BrokerRegisterFormFactory',
            'Users\Form\AgentSetupInfoForm' => 'Users\Form\Factory\AgentSetupInfoFormFactory',
            'Users\Form\BrokerSetupInfoForm' => 'Users\Form\Factory\BrokerSetupInfoFormFactory',
            'Users\Form\BrokerSetUpDataForm' => 'Users\Form\Factory\BrokerSetUpDataFormFactory',
            "Users\Form\BrokerCeoForm"=>"Users\Form\Factory\BrokerCeoFormFactory",
            "Users\Form\BrokerChildForm"=>"Users\Form\Factory\BrokerChildFormFactory"
        )
    )
    ,
    
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

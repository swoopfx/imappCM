<?php
namespace GeneralServicer;

return array(
    
    'controllers' => array(
        'invokables' => array(
            'GeneralServicer\Controller\Servicer' => 'GeneralServicer\Controller\ServicerController',
//             'GeneralServicer\Controller\General' => 'GeneralServicer\Controller\GeneralController'
            // 'GeneralServicer\Controller\Portal' => 'GeneralServicer\Controller\PortalController'
        ),
        'factories' => array(
            'GeneralServicer\Controller\Portal' => 'GeneralServicer\Controller\Factory\PortalControllerFactory'
            // 'GeneralServicer\Controller\General' => 'GeneralServicer\Controller\Factory\GeneralControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'redirectPlugin' => 'GeneralServicer\Controller\Plugin\Factory\RedirectPluginFactory',
            'setupRedirectPlugin' => 'GeneralServicer\Controller\Plugin\Factory\SetupFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'general-servicer' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/service',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'GeneralServicer\Controller',
                        'controller' => 'Servicer',
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
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
//             'general' => array(
//                 'type' => 'Literal',
//                 'options' => array(
//                     // Change this to something specific to your module
//                     'route' => '/generally',
//                     'defaults' => array(
//                         // Change this value to reflect the namespace in which
//                         // the controllers for your module are found
//                         '__NAMESPACE__' => 'General\Controller',
//                         'controller' => 'General',
//                         'action' => 'index'
//                     )
//                 ),
//                 'may_terminate' => true,
//                 'child_routes' => array(
//                     // This route is a sane default when developing a module;
//                     // as you solidify the routes for your module, however,
//                     // you may want to remove it and replace it with more
//                     // specific routes.
//                     'default' => array(
//                         'type' => 'Segment',
//                         'options' => array(
//                             'route' => '[/:action]',
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
//                             ),
//                             'defaults' => array()
//                         )
//                     )
//                 )
//             ),
            
            'insurer_portal' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/insurerportal',
                   
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'GeneralServicer\Controller',
                        'controller' => 'Portal',
                        'action' => 'splash'
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
                            'route' => '[/:action[/:pxd]]',
                            'pxd' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'constraints' => array(
                                'pxd' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            
            )
        )
    ),
    'view_manager' => array(
        'display_exceptions' => true,
        'strategies' => array(
            'ViewJsonStrategy'
        ),
        'template_path_stack' => array(
            'GeneralServicer' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            "general-ui-upload-form" => __DIR__ . '/../view/partials/general-ui-upload-form.phtml',
            "general-dropzone-upload-form-snippet" => __DIR__ . '/../view/partials/general-dropzone-upload-form-snippet.phtml',
            'doc-preview-snipet' => __DIR__ . '/../view/partials/doc-preview-snipet.phtml',
            "general-manual-premium-form" => __DIR__ . '/../view/partials/general-manual-premium-form.phtml',
            'general-doc-snipet' => __DIR__ . '/../view/partials/doc-snipet.phtml',
            "general-error-ponters" => __DIR__ . '/../view/partials/general-error-pointers-snipet.phtml',
            "general-datable-script" => __DIR__ . '/../view/partials/general-datable-script.phtml',
            "general-upload-form" => __DIR__ . '/../view/partials/general-upload-form.phtml',
            "generic-upload-form" => __DIR__ . '/../view/partials/generic-upload-form.phtml',
            
            // Begin general mail
            "general-servicer-message-sent-mail" => __DIR__ . '/../view/email/general_servicer_message_sent.phtml',
            
            // End General Mail
            
            // Begin Broker Mail
            
            "general-mail-default" => __DIR__ . '/../view/email/brokermail/general-mail-default.phtml',
            "general-user-confirm-email" => __DIR__ . '/../view/email/brokermail/general-user-confirm-email.phtml',
            "general-broker-config-email" => __DIR__ . '/../view/email/brokermail/general-broker-config-email.phtml',
            "general-broker-receipt" => __DIR__ . '/../view/email/brokermail/general-broker-payment-receipt-email.phtml',
            
            "general_generic" => __DIR__ . '/../view/email/brokermail/general_generic.phtml',
            
            
            // Claims
            "general_claims_remind_customer" => __DIR__ . '/../view/email/brokermail/claims/general_claims_remind_customer.phtml',
            
            
            // transaction
            
            // Invoice
            "general-broker-customer-outstanding-invoice-email" => __DIR__ . '/../view/email/brokermail/invoice/customer-outstanding-invoice.phtml',
            
            // Policy and CoverNote
            "general-broker-expired-covernote-notify-mail" => __DIR__ . '/../view/email/brokermail/policy/general-broker-expired-covernote-notify-mail.phtml',
            "general-broker-expiring-policy-notify-mail" => __DIR__ . '/../view/email/brokermail/policy/general-broker-expiring-policy-notify-mail.phtml',
            
            // End BrokerMail
            
            // Begin Customer Mails
            "general-customer-default-mail" => __DIR__ . '/../view/email/customermail/general-mail-default.phtml',
            "general-customer-payment-receipt-email" => __DIR__ . '/../view/email/customermail/general-customer-payment-receipt-email.phtml',
           
            // transaction
            "general-customer-transaction" => __DIR__ . '/../view/email/customermail/transaction/general-customer-transaction.phtml',
            
            // Policy
            "general-customer-policy-renewal-notify" => __DIR__ . '/../view/email/customermail/policy/general-customer-policy-renewal-notify-mail.phtml',
            
            //
            "general-customer-welcome-aboard" => __DIR__ . '/../view/email/customermail/register/welcome-aboard.phtml',
            // Invoice
            "general-customer-invoice-expiring" => __DIR__ . '/../view/email/customermail/invoice/general-customer-invoice-expiring-notify-mail.phtml',
            // End Customer Mails
            
            // modal
            "general-modal-view-document" => __DIR__ . '/../view/partials/modal/general-modal-view-document.phtml',
            "general-modal-iframe-view" => __DIR__ . '/../view/partials/modal/general-modal-iframe-view.phtml',
            "general-modal-export-to-insurer" => __DIR__ . '/../view/partials/modal/general-modal-export-to-insurer.phtml',
            "general_insurer_portal_list" => __DIR__ . '/../view/partials/modal/general_insurer_list_portal.phtml',
            "general_the_portal_modal" => __DIR__ . '/../view/partials/modal/general_the_portal_modal.phtml',
            "general_portal_info_snippet" => __DIR__ . '/../view/partials/modal/general_portal_info_snippet.phtml',
            
            // Begin Generic Mail
            "general-successful-transaction" => __DIR__ . '/../view/email/successful_transaction.phtml',
            
            // Portal Partial
            "general-portal-not-authorized" => __DIR__ . '/../view/partials/portal/general-portal-not-authorized.phtml',
            "general-portal-missing-uid" => __DIR__ . '/../view/partials/portal/general-portal-missing-uid.phtml',
            "general-portal-no-portuid" => __DIR__ . '/../view/partials/portal/general-portal-no-portuid.phtml',
            "general-portal-proposal" => __DIR__ . '/../view/partials/portal/general-portal-proposal.phtml'
        
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            "GeneralServicer\Service\BlobService" => "GeneralServicer\Service\Factory\BlobFactory",
            'general_service_imprint' => 'GeneralServicer\Service\Factory\ImprintServiceFactory',
            'dashboard_service_manager' => 'GeneralServicer\Service\Factory\DashBoardFactory',
            'userRegisterService' => 'GeneralServicer\Service\Factory\RegisterServiceFactory',
            'GeneralServicer\Service\MailService' => "GeneralServicer\Service\Factory\MailFactory",
            "GeneralServicer\Service\PremiumService" => "GeneralServicer\Service\Factory\PremiumFactory",
            'GeneralServicer\Service\PaymentCryptService' => 'GeneralServicer\Service\Factory\PaymentCryptFactory',
            'GeneralServicer\Service\BrokerSubscriptionService' => 'GeneralServicer\Service\Factory\BrokerSubscriptionServiceFactory',
            'GeneralServicer\Service\GeneralService' => 'GeneralServicer\Service\Factory\GeneralServiceFactory',
            'GeneralServicer\Service\CurrencyService' => 'GeneralServicer\Service\Factory\CurrencyServiceFactory',
            'GeneralServicer\Service\DateCalculationService' => 'GeneralServicer\Service\Factory\DateCalculationServiceFactory',
            'GeneralServicer\Service\PortalService' => 'GeneralServicer\Service\Factory\PortalServiceFactory',
            'GeneralServicer\Service\FireBaseService' => 'GeneralServicer\Service\Factory\FirebaseFactory',
            "GeneralServicer\Service\PusherChatkitService"=>"GeneralServicer\Service\Factory\PusherChatkitServiceFactory"
            
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
    'form_elements' => array(
        'factories' => array(
            "GeneralServicer\Form\Fieldset\ExportToInsurerFieldset" => "GeneralServicer\Form\Fieldset\Factory\ExportToInsurerFieldsetFactory",
            "GeneralServicer\Form\Fieldset\ManualPremiumFieldset" => "GeneralServicer\Form\Fieldset\Factory\ManualPremiumFieldsetFactory",
            "GeneralServicer\Form\ManualPremiumForm" => "GeneralServicer\Form\Factory\ManualPremiumFormFactory",
            "GeneralServicer\Form\DropZoneDocUploadForm" => "GeneralServicer\Form\Factory\DropZoneDocUploadFormFactory",
            'GeneralServicer\Form\Fieldset\UploadFieldset' => 'GeneralServicer\Form\Fieldset\Factory\UploadFieldsetFactory',
            'GeneralServicer\Form\Fieldset\DocumentFieldset' => 'GeneralServicer\Form\Fieldset\Factory\DocumentFieldsetFactory',
            'GeneralServicer\Form\GenericUploadForm' => 'GeneralServicer\Form\Factory\GenericUploadFormFactory',
            'GeneralServicer\Form\GeneralUploadForm' => 'GeneralServicer\Form\Factory\GeneralUploadFormFactory',
            "GeneralServicer\Form\UploadForm" => "GeneralServicer\Form\Factory\UploadFormFactory",
            "GeneralServicer\Form\LogoUploadForm" => "GeneralServicer\Form\Factory\LogoUploadFormFactory",
            "GeneralServicer\Form\ExportToInsurerForm" => "GeneralServicer\Form\Factory\ExportToInsurerFormFactory"
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'statusHelper' => 'GeneralServicer\View\Helper\StatusViewHelper',
            'myCurrencyFormat' => 'GeneralServicer\View\Helper\MyCurrencyHelper',
            'paymentMethodViewHelper' => 'GeneralServicer\View\Helper\PaymentMethodViewHelper',
            'insurerLogohelper' => 'GeneralServicer\View\Helper\InsurerLogoHelper',
            "broker_logo_helper" => "GeneralServicer\View\Helper\BrokerLogoHelper",
            'nigeria_bank_logo_helper' => "GeneralServicer\View\Helper\BankLogoHelper",
            "offer_process_estimated_premium" => "Offer\View\Helper\OfferProcessPremiumViewHelper",
            "general_dashboard_notification_helper" => "GeneralServicer\View\Helper\NtificationViewHelper",
            "invoicePaymentStatus" => "GeneralServicer\View\Helper\PaymentStatus"
        )
    
    )

);

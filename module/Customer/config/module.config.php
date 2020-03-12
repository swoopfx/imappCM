<?php
namespace Customer;

return array(
    'controllers' => array(
        'invokables' => array(
            'Customer\Controller\Offset' => 'Customer\Controller\OffsetController'
        ),
        
        'factories' => array(
            'Customer\Controller\Index' => 'Customer\Controller\Factory\IndexControllerFactory',
            'Customer\Controller\Client' => 'Customer\Controller\Factory\ClientControllerFactory',
            'Customer\Controller\Invoice' => 'Customer\Controller\Factory\InvoiceControllerFactory',
            "Customer\Controller\Claims" => "Customer\Controller\Factory\ClaimsControllerFactory",
            "Customer\Controller\Packages" => "Customer\Controller\Factory\PackagesControllerFactory",
            'Customer\Controller\Board' => 'Customer\Controller\Factory\BoardControllerFactory',
            'Customer\Controller\Offer' => 'Customer\Controller\Factory\OfferControllerFactory',
            'Customer\Controller\Policy' => 'Customer\Controller\Factory\PolicyControllerFactory',
            'Customer\Controller\Risk' => 'Customer\Controller\Factory\RiskControllerFactory',
            'Customer\Controller\Proposal' => 'Customer\Controller\Factory\ProposalControllerFactory',
            'Customer\Controller\Message' => 'Customer\Controller\Factory\MessageControllerFactory',
            'Customer\Controller\Object' => 'Customer\Controller\Factory\ObjectControllerFactory',
            'Customer\Controller\Transaction' => 'Customer\Controller\Factory\TransactionControllerFactory',
            "Customer\Controller\Payment"=>"Customer\Controller\Factory\PaymentControllerFactory",
        
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            "customerRedirectPlugin" => "Customer\Controller\Plugin\Factory\CustomerRedirectPluginFactory"
        )
    ),
    'router' => array(
        'routes' => array(
            'customer' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/customer',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Index',
                        'action' => 'new'
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
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'offset' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/landing',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Offset',
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
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_payment' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/payment',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Payment',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_object' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/property',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Object',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_pack' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/packages',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Packages',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_message' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/messages',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Message',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_proposal' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/proposal',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Proposal',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_risk' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/risk',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Risk',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_transact' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/transaction',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Transaction',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_policy' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/policy',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Policy',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_invoice' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/invoice',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Invoice',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_claims' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/claims',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Claims',
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'cus_offer' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/my/offer',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Offer',
                        'action' => 'active'
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
                                'id' => '[a-zA-Z0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'client_def' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/client-def/:action[/:id[/:i]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9]*',
                        'i' => '[a-zA-Z0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Client'
                    )
                
                ),
                'may_terminate' => true
            ),
            
            'client_login' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/q-client/[:brokerid]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'brokerid' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Client',
                        'action' => 'login'
                    )
                ),
                'may_terminate' => true
            ),
            
            'client_forgot' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/q-forgot/[:brokerid]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'brokerid' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Client',
                        'action' => 'forgot'
                    )
                ),
                'may_terminate' => true
            ),
            
            'client_logout' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/client-q/logout',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'userid' => '[0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Client',
                        'action' => 'logout'
                    )
                ),
                'may_terminate' => true
            ),
            
            'client_register' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/q-register/:brokerid',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'brokerid' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Client',
                        'action' => 'register'
                    )
                ),
                'may_terminate' => true
            ),
            
            'board' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/board[/:action]',
                    'constraints' => array(
                        // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Board',
                        'action' => 'dashboard'
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
                                'id' => '[a-zA-Z0-9]*'
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
            'Customer' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            
            // BEGIN PDF 
            "customer-proposal-pdf"=> __DIR__ . '/../view/customer/proposal/customer-proposal-list.phtml',
            
            // END PDF 
            
            
            // BEGIN CLAIMS
            "customer-claims-policy-details"=> __DIR__ . '/../view/customer/claims/partial/modal/customer_claims_policy_details.phtml',
            
            // END CLAIMS
            
            
            'client-layout-login' => __DIR__ . '/../view/layout/login.phtml',
            'client-layout-board' => __DIR__ . '/../view/layout/client.phtml',
            'customer-layout-invoice' => __DIR__ . '/../view/layout/customer-invoice.phtml',
            
            // Index Modal
            'customer-edit-profile-modal-snippet' => __DIR__ . '/../view/customer/index/modal/edit-profile-modal-snippet.phtml',
            
            // Message
            "customer-message-form-snippet"=>__DIR__ . '/../view/partials/message/customer-message-form-snippet.phtml',
            // Begin general partial
            "customer-analytics"=>__DIR__ . '/../view/partials/customer-analytics.phtml',
            'customer-new' => __DIR__ . '/../view/partials/customer-new.phtml',
            'client-register-snipet' => __DIR__ . '/../view/partials/client-register-snipet.phtml',
            'customer-info-snipet' => __DIR__ . '/../view/partials/customer-info-snipet.phtml',
            'customer-unpublished-policy-snipet' => __DIR__ . '/../view/partials/customer-unpublished-policy-snippet.phtml',
            'customer-proposal-action' => __DIR__ . '/../view/partials/customer-proposal-action-snipet.phtml',
            'customer-board-featured-packages' => __DIR__ . '/../view/customer/board/partial/customer-board-featured-packages.phtml',
            'customer-policy-snipet' => __DIR__ . '/../view/partials/customer-policy-snipet.phtml',
            'customer-proposal-snipet' => __DIR__ . '/../view/partials/customer-pproposal-snipet.phtml',
            'customer-invoice-snipet' => __DIR__ . '/../view/partials/customer-invoices-snipet.phtml',
            'customer-claims-snipet' => __DIR__ . '/../view/partials/customer-claims-snipet.phtml',
            'customer-offer-snipet' => __DIR__ . '/../view/partials/customer-offer-snipet.phtml',
            'customer-list-snipet' => __DIR__ . '/../view/partials/customer-list-snipet.phtml',
            'customer-mother-broker-snipet' => __DIR__ . '/../view/partials/customer-mother-broker-snipet.phtml',
            'customer-side-bar-list-snipet' => __DIR__ . '/../view/customer/index/partials/customer-side-bar-list-snipet.phtml',
            
            // Proposal Partials 
            'customer_proposal_document_modal_list' => __DIR__ . '/../view/partials/proposal/customer_proposal_document_modal_list.phtml',
            
            // End General partials
            
            // client partials
            
            // End client partials
            
            // Begin Packages
            'customer-client-pincode-form' => __DIR__ . '/../view/partials/client/change-pin-form-snippet.phtml',
            "customer-pin-form-form"=> __DIR__ . '/../view/partials/customer-pincode-form-form.phtml',
            // ENd Packgaes
            // begin partials packages
            "packages_acquired_packages_message_form" => __DIR__ . '/../view/partials/packages/package-acquired-package-message--form.phtml',
            'cuatomer_packages_grid_snipet' => __DIR__ . '/../view/partials/packages/customer_packages_grid.phtml',
            'customer_packages_active_list' => __DIR__ . '/../view/partials/packages/customer_packages_active_package_list.phtml',
            'customer_packages_list_snipet' => __DIR__ . '/../view/partials/packages/customer_packages_list_snipet.phtml',
            // end partials packages
            'customer_layout_header' => __DIR__ . '/../view/layout/partials/customer_layout_headset.phtml',
            'customer_layout_top_menu' => __DIR__ . '/../view/layout/partials/customer_layout_top_menu_bar.phtml',
            'customer_layout_footer' => __DIR__ . '/../view/layout/partials/customer_layout_footer.phtml',
            'customer_layout_container' => __DIR__ . '/../view/layout/partials/customer_layout_container.phtml',
            'customer_layout_topbar' => __DIR__ . '/../view/layout/partials/customer_layout_topbar.phtml',
            
            // begin Board partial snipets
             // modal for board 
            "customer-board-change-login-pin-form"=> __DIR__ . '/../view/customer/board/partial/modal/customer-board-pin-form.phtml',
            "customer-board-edit-profile-form"=> __DIR__ . '/../view/customer/board/partial/modal/customer-board-edit-profile-form.phtml',
            // End modal
            
            
            // Begin Modal for Payment
            "customer-payment-credit-card-form"=> __DIR__ . '/../view/partials/payment/customer-payment-creditcard-form.phtml',
            // End Modal for payment
            
            'customer-board-sidebar' => __DIR__ . '/../view/customer/board/partial/customer-board-sidebar.phtml',
            'customer-board-policy' => __DIR__ . '/../view/customer/board/partial/customer-board-policy.phtml',
            'customer-board-covernote' => __DIR__ . '/../view/customer/board/partial/customer-board-covervote.phtml',
            'customer-board-proposal' => __DIR__ . '/../view/customer/board/partial/customer-board-proposal.phtml',
            'customer-board-invoice' => __DIR__ . '/../view/customer/board/partial/customer-board-invoice.phtml',
            'customer-board-active-package' => __DIR__ . '/../view/customer/board/partial/customer-board-active-package.phtml',
            'customer-board-active-offer' => __DIR__ . '/../view/customer/board/partial/customer-board-offer.phtml',
            "customer_payment_bank_account" => __DIR__ . '/../view/customer/board/partial/customer-payment-bank-account-snippet.phtml',
            "customer-invoice-details-snipet" => __DIR__ . '/../view/partials/board/customer-invoice-details-snippet.phtml',
            "customer-registered-card-details"=>__DIR__ . '/../view/partials/board/customer-registered-card-details.phtml',
            "customer_board_edit_profile_snippet" => __DIR__ . '/../view/customer/board/partial/customer_board_edit_profile_snippet.phtml',
            // End Board partial snipet
            
            // Begin Offer partials
            "customer-offer-active-list" => __DIR__ . '/../view/partials/offer/customer-offer-active-list.phtml',
            "customer-offer-view-main-offer-info" => __DIR__ . '/../view/partials/offer/view/customer-offer-view-main-offer-info.phtml',
            "customer-offer-view-premium" => __DIR__ . '/../view/partials/offer/view/customer-offer-view-premium-snipet.phtml',
            "customer-offer-view-object-docs-info" => __DIR__ . '/../view/partials/offer/view/customer-offer-view-object-docs-info.phtml',
            "customer-offer-view-comments" => __DIR__ . '/../view/partials/offer/view/customer-offer-view-comment-snipet.phtml',
            "customer-offer-action" => __DIR__ . '/../view/customer/offer/partials/customer-offer-actions.phtml',
            "customer-offer-menu" => __DIR__ . '/../view/customer/offer/partials/customer-offer-menu.phtml',
            "customer-offer-form-snippet" => __DIR__ . '/../view/customer/offer/partials/customer-offer-form-snippet.phtml',
            "customer-offer-details-snippet" => __DIR__ . '/../view/customer/offer/partials/customer-offer-details-snippet.phtml',
            "customer-offer-now-premium-details" => __DIR__ . '/../view/customer/offer/partials/customer-offer-now-premium-details.phtml',
            "customer-message-offer-form" => __DIR__ . '/../view/customer/offer/partials/customer-message-offer-form.phtml',
            // End Offer partials
            
            // Begin customer Object snippet
            "customer-package-object-form" => __DIR__ . '/../view/partials/packages/customer-package-object-form-snipet.phtml',
            "customer-package-object-central-form" => __DIR__ . '/../view/partials/packages/microform/customer-package-object-central-form.phtml',
            "customer-package-object-motor-form" => __DIR__ . '/../view/partials/packages/microform/customer-packageobject-motor-data-form.phtml',
            // End customer Object
            
            // Begin Customer Object
            "customer_select_object_offer_snippet" => __DIR__ . '/../view/partials/object/customer-select-object-offer-snipet-form.phtml',
            
            "customer_object_snippet_all" => __DIR__ . '/../view/partials/object/customer_object_all_snippet.phtml',
            // End Customer Object
            
            // Begin Customer Invoice
            "customer-invoices-all-snipet" => __DIR__ . '/../view/customer/invoice/partials/customer-invoice-all-snipet.phtml',
            "customer-invoice-not-logged-snipet" => __DIR__ . '/../view/customer/invoice/partials/customer-invoice-not-logged-snippet.phtml',
            "customer-invoice-view-logged-snipet" => __DIR__ . '/../view/customer/invoice/partials/customer-invoice-view-logged.phtml',
            "customer-invoice-view-snippet" => __DIR__ . '/../view/customer/invoice/partials/customer-invoice-view-snippet.phtml',
            // End Customer Invoices
            
            // Begin Claims Snipets
            "customer_claims_upload_accident_images_snippet" => __DIR__ . '/../view/customer/claims/partial/customer-claims-upload-accident-snippet.phtml',
            "customer_claims_lay_pre_claims_snippet" => __DIR__ . '/../view/customer/claims/partial/customer_claims_lay_snippet.phtml',
            "customer_claims_menu" => __DIR__ . '/../view/customer/claims/partial/customer_claims_menu.phtml',
            "customaer_claims_all_unsettled" => __DIR__ . '/../view/customer/claims/partial/customer_claims_all_snippet.phtml',
            // End claims snippet
            // Begin customer Proposal partial
            "customer-proposal-my-proposal" => __DIR__ . '/../view/customer/proposal/partial/customer-proposal-my-proposal.phtml',
            "customer_message_proposal_form"=>__DIR__ . '/../view/customer/proposal/partial/customer-message-proposal-form.phtml',
            // End customer Proposal partial
            
            // Begin policy partial policy
            'customer-upload-policy-form-modal-snippet' => __DIR__ . '/../view/customer/index/modal/upload-policy-form-modal-snippet.phtml',
            
            "customer-policy-index" => __DIR__ . '/../view/partials/policy/customer-policy-index.phtml',
            "customer-policy-menu" => __DIR__ . '/../view/customer/policy/partials/customer-policy-menu.phtml',
            // End partial policy
            
            
            'customer_packages_packges_category_menu' => __DIR__ . '/../view/customer/packages/package/packages_category.phtml',
            'email-customer-broker-confirm-email' => __DIR__ . '/../view/email/broker-confirm-passord.phtml',
            
            // Sub Layout 
            'sub-layout-packages' => __DIR__ . '/../view/partials/sub-layout/packages.phtml',
            "sub-layout-micropayment-list-snippet"=>__DIR__ . '/../view/partials/sub-layout/micropayment-list-snippet.phtml',
            
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            "Customer\Service\CustomerProposalService"=>"Customer\Service\Factory\CustomerProposalServiceFactory",
            "Customer\Service\ClientBlobService" => "Customer\Service\Factory\ClientBlobServiceFactory",
            'Customer\Service\CustomerService' => 'Customer\Service\Factory\CustomerFactory',
            'Customer\Service\ClientGeneralService' => 'Customer\Service\Factory\ClientGeneralServiceFactory',
            'Customer\Service\CustomerBoardService' => 'Customer\Service\Factory\CustomerBoardServiceFactory',
            'Customer\Service\ClientService' => 'Customer\Service\Factory\ClinetServiceFactory',
            "Customer\Service\CustomerPackageService" => "Customer\Service\Factory\CustomerPackageServiceFactory"
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
        "invokables" => array(
            // "Customer\Form\Fieldset\CustomerClaimsPreFeildset"=>"Customer\Form\Fieldset\CustomerClaimsPreFeildset"
        ),
        'factories' => array(
            'Customer\Form\Fieldset\LoginFieldset' => 'Customer\Form\Fieldset\Factory\LoginFieldsetFactory',
            "Customer\Form\Fieldset\CustomerPinCodeFieldset" => "Customer\Form\Fieldset\Factory\CustomerPinCodeFieldsetFactory",
            'Customer\Form\Fieldset\CustomerFieldset' => 'Customer\Form\Fieldset\Factory\CustomerFieldsetFactory',
            "Customer\Form\CustomerPackageObjectForm" => "Customer\Form\Factory\CustomerPackageObjectFormFactory",
            "Customer\Form\CustomerPinCodeForm" => "Customer\Form\Factory\CustomerPinCodeFormFactory",
            "Customer\Form\CustomerClaimsPreForm" => "Customer\Form\Factory\CustomerClaimsPreFormFactory",
            "Customer\Form\Fieldset\CustomerClaimsPreFieldset" => "Customer\Form\Fieldset\Factory\CustomerClaimsPreFieldsetFactory",
            "Customer\Form\Fieldset\CustomerForgotPasswordFieldset" => 'Customer\Form\Fieldset\Factory\CustomerForgotPasswordFieldsetFactory',
            "Customer\Form\CustomerForgottenPasswordForm" => "Customer\Form\Factory\CustomerForgotPasswordFormFactory"
        )
        // 'Customer\Form\ClientLoginForm'=>'Customer\Form\Factory\ClientLoginFormFactory',
        // 'Customer\Form\ClientRegisterForm'=>'Customer\Form\Factory\ClientRegisterFormFactory',
    
    ),
    'view_helpers' => array(
        'invokables' => array(
            "customer_layout_customer_name_helper" => "Customer\View\Helper\CustomerLayoutCustomerNameHelper",
            "customer_login_broker_logo_helper" => "Customer\View\Helper\BrokerLogoHelper",
            "customer_broker_logo_helper" => "Customer\View\Helper\CustomerBrokerLogoHelper",
            'customer_category_avatar_helper' => 'Customer\View\Helper\CustomerCategoryAvatarHelper',
            'customer_claims_snipet_helper' => 'Customer\View\Helper\CustomerClaimsMicroSnipetViewHelper',
            'customer_category_type_view_helper' => 'Customer\View\Helper\CustomerCategoryHelper',
            'customer_dashboard_menu_helper' => 'Customer\View\Helper\CutomerDashboardMenuHelper',
            'assigned_child_broker_button_helper' => 'Customer\View\Helper\AssignedChildBrokerButtonHelper',
            'customer_broker_name_helper' => "Customer\View\Helper\BrokerNameHelper",
            'package_value_representation' => "Customer\View\Helper\Customer\PackageValueRepViewHelper",
            'customer_board_message' => "Customer\View\Helper\Board\BoardMessageHelper",
            'board_package_value_type_helper' => "Customer\View\Helper\Board\BoardActivePackageValueTypeHelper",
           
            'customer_package_value_representation' => "Customer\View\Helper\Customer\PackageValueRepViewHelper",
            
            //Board
            "board_customer_account_manager"=>"Customer\View\Helper\Board\BoardCustomerAccountOfficerHelper",
            "board_payment_amount_payable"=>"Customer\View\Helper\Board\CustomerPaymentAmountPayableHelper",
            // Customer
            "customerAssignedBroker" => "Customer\View\Helper\Customer\AssignedBrokerListHelper",
            // End Customer
            
            // Begin Claims ViewHelper
            
            "customerClaimsCommentViewhelper"=>"Customer\View\Helper\CLaims\CustomerClaimsCommentViewHelper",
            
            // End Claims Veiwheper
            "viewAcc"=>"Customer\View\Helper\CLaims\CustomerClaimsAccidentImageListHelper",
            // Begin Customer Proposal ViewHelper
            "customerProposalDocListHelper"=>"Customer\View\Helper\Proposal\CustomerProposalDocumentListHelper",
            "customer_proposal_premium_viewhelper" => "Customer\View\Helper\Proposal\CustomerProposalPremiumViewHelper",
            "customer_proposal_list_object" => "Customer\View\Helper\Proposal\CustomerProposalListObject",
            // End Customer Proposal ViewHelper
            
            // Begin Offer View Helper
            "customer_offer_now_premium_helper" => "Customer\View\Helper\Offer\CustomerOfferPremiumViewHelper",
            "customer_offer_object_list" => "Customer\View\Helper\Offer\ConsumerOfferListObjecs",
            "customer_offer_recommneded_insurer_condition" => "Customer\View\Helper\Offer\AcceptRecommendedInsurerViewHelper",
            // End Offer View Helper
            
            
            
            // Begin Packages
            "customer_packages_image_helper" => "Customer\View\Helper\Packages\CustomerPackageImageHelper",
            "customer_package_object_list_helper" => "Customer\View\Helper\Packages\CustomerPackageObjectList",
            "customer_package_premium_viewhelper" => "Customer\View\Helper\Packages\CustomerPackagePremiumViewHelper",
            "customerFeaturedPackage" => "Customer\View\Helper\Packages\CustomerFeaturedPackageHelper",
            // End Packages
            
            // Policy Viehelper
            "customerPolicyAllActionButtonHelper" => "Customer\View\Helper\Policy\CustomerPolicyAllActionHelper",
            "customerPolicyDocumentListHelper"=>"Customer\View\Helper\Policy\CutomerPolicyDocumentListHelper",
            // End Policy View Helper
            
            // Begin Object Helper
            "customerObjectFullDetailsHelper" => "Customer\View\Helper\Object\CustomerObjectFullDetailsViewHelper",
            "customerAllObjectStatus" => "Customer\View\Helper\Object\CustomerAllObjectStatus",
            "customerObjectUploadedDocHelper"=>"Customer\View\Helper\Object\CustomerObjectUploadedDocumentHelper",
            // End Object Helper
            
            // Begin Customer ClaimsHelpper
            "customer_claims_unsettledclaims_action_helper" => "Customer\View\Helper\CLaims\CustomerUnsettledClaimsActionHelper",
            
            //Payment ViewHelper
            "customerPaymentMicroPaymentList"=>"Customer\View\Helper\Board\CustomerPaymentMicroList",
            
            
            
        )
    )
);

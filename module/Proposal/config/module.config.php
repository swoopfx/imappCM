<?php
namespace Proposal;

return array(
    'controllers' => array(
        'invokables' => array(
            // 'Proposal\Controller\Index' => 'Proposal\Controller\IndexController',
        ),
        'factories' => array(
            'Proposal\Controller\Index' => 'Proposal\Controller\Factory\IndexControllerFactory',
            'Proposal\Controller\Proposalmodal' => 'Proposal\Controller\Factory\ProposalmodalControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'proposal' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/proposal',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Proposal\Controller',
                        'controller' => 'Index',
                        'action' => 'create'
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
                            'route' => '[/:action[/:id[/:pro]]]',
                            'constraints' => array(
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                // 'customer' => '[0-9]*',
                                'id' => '[a-zA-Z0-9_-]*',
                                'pro' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    ),
                    
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:customer]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'customer' => '[a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            
            'proposalmodal' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/proposalmodal',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Proposal\Controller',
                        'controller' => 'Proposalmodal',
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
                                
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*',
                                'pro' => '[a-zA-Z0-9_-]*'
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
            'Proposal' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        ),
        'template_map' => array(
            'test-add-object' => __DIR__ . '/../view/proposal/add-object.phtml',
            'test-foo' => __DIR__ . '/../view/proposal/foo.phtml',
            'proposal-create-snipet' => __DIR__ . '/../view/proposal/partials/proposal-create-snipet.phtml',
            'proposal-my-proposal-snipet' => __DIR__ . '/../view/proposal/partials/proposal-my-proposal-snipet.phtml',
            "proposal-view-proposal" => __DIR__ . '/../view/proposal/partials/proposal-view-snipet.phtml',
            "proposal-customer-snipet" => __DIR__ . '/../view/proposal/partials/proposal-customer-snipet.phtml',
            "proposal-invoices-snipet" => __DIR__ . '/../view/proposal/partials/proposal-invoices-snipet.phtml',
            "proposal-related-objects-snipet" => __DIR__ . '/../view/proposal/partials/proposal-related-objects.phtml',
            "proposal-customer-create-side-snipet" => __DIR__ . '/../view/proposal/index/partials/proposal-customer-create-side-snipet.phtml',
            "proposal-process-proposal-object-snipet" => __DIR__ . '/../view/proposal/index/partials/proposal-create-proposal-object-snipet.phtml',
            "proposal-create-proposal-uploaded-document-snipet" => __DIR__ . '/../view/proposal/index/partials/proposal-create-proposal-uploaded-document-snipet.phtml',
            "proposal-view-generated-premium-snipet" => __DIR__ . '/../view/proposal/partials/proposal-view-generated-premium-snipet.phtml',
            "proposal-view-buttons-snipet" => __DIR__ . '/../view/proposal/partials/proposal-view-buttons-snipet.phtml',
            "proposal-ajax-proposal-edit" => __DIR__ . '/../view/proposal/partials/proposal-ajax-proposal-edit.phtml',
            "proposal-process-upper-button" => __DIR__ . '/../view/proposal/index/partials/proposal-process-upper-buttons.phtml',
            "proposal-create-pdf" => __DIR__ . '/../view/proposal/partials/proposal-create-pdf.phtml',
            
            
            // proposal forms
            "proposal-form-snipet" => __DIR__ . '/../view/proposal/partials/proposal-form-snipet.phtml',
            // end proposal forms
            
            // Message snippet
            "proposal-message-snipet" => __DIR__ . '/../view/proposal/partials/proposal-message-snipet.phtml',
            
            // Modal
            "proposal-customer-payment-form-admin" => __DIR__ . '/../view/proposal/partials/modal/proposal-customer-payment-form-admin.phtml',
            "proposal-invoice-preview-modal" => __DIR__ . '/../view/proposal/partials/modal/proposal-invoice-preview-modal.phtml',
            "proposal-preview-details-snippet" => __DIR__ . '/../view/proposal/partials/modal/proposal-preview-details-snippet.phtml',
            "proposal-form-modal-snippet" => __DIR__ . '/../view/proposal/partials/modal/proposal-form-modal-snippet.phtml',
            "proposal-cover-details-modal" => __DIR__ . '/../view/proposal/partials/modal/proposal-cover-details-modal.phtml',
            "proposal-desc-modal" => __DIR__ . '/../view/proposal/partials/modal/proposal_desc_modal.phtml',
            "proposal-modal-view-covernote" => __DIR__ . '/../view/proposal/partials/modal/proposal_modal_view_covernote.phtml',
            
        
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Proposal\Service\ProposalService' => 'Proposal\Service\Factory\ProposalServiceFactory'
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
            'Proposal\Form\Fieldset\ProposalFieldset' => 'Proposal\Form\Fieldset\Factory\ProposalFieldsetFactory',
            'Proposal\Form\SelectCustomerForm' => 'Proposal\Form\Factory\SelectCustomerFormFactory',
            'Proposal\Form\ProposalForm' => 'Proposal\Form\Factory\ProposalFormFactory'
        )
    ),
    "view_helpers" => array(
        'invokables' => array(
            "proposal_process_doc_helper" => "Proposal\View\Helper\ProposalProcessDocHelper",
            "proposal_process_premium_helper" => "Proposal\View\Helper\ProposalProcessPremiumViewHelper",
            "proposal_object_list_helper" => "Proposal\View\Helper\ProposalObjectListHelper",
            "proposal_process_payment_helper" => "Proposal\View\Helper\ProposalProcessPaymentStatus",
            "proposal_process_customer_visibilty" => "Proposal\View\Helper\ProposalProcessCustomerVisibilityHelper",
            "proposal_process_covernote" => "Proposal\View\Helper\ProposalProcessCoverNoteHelper",
            "proposal_view_status_helper" => "Proposal\View\Helper\ProposalViewStatusVieHelper"
        )
    )
);

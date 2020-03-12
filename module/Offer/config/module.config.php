<?php
namespace Offer;

return array(
    
    'service_manager' => array(
        'factories' => array(
            
            'Offer\Service\OfferService' => 'Offer\Service\Factory\OfferFactory',
            'offer_status_service' => 'Offer\Service\Factory\OfferStatusServiceFactory',
            'offer_index_controller_service' => 'Offer\Service\Factory\OfferIndexControllerFactory'
        )
    
    ),
    'controllers' => array(
        'invokables' => array(),
        // 'Offer\Controller\Index' => 'Offer\Controller\IndexController'
        'factories' => array(
            'Offer\Controller\Index' => 'Offer\Controller\Factory\IndexControllerFactory'
        )
    
    ),
    'router' => array(
        'routes' => array(
            
            'offer' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/offer',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Offer\Controller',
                        'controller' => 'Index',
                        'action' => 'view-all'
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
            'Offer' => __DIR__ . '/../view'
        
        ),
        'template_map' => array(
            'offer-view-snipet' => __DIR__ . '/../view/partials/offer-view-snipet.phtml',
            "offer-form-snipet"=>__DIR__ . '/../view/partials/offer-form-snipet.phtml',
            'offer-premium-snipet' => __DIR__ . '/../view/partials/offer-premium-snipet.phtml',
            'offer-object-selected' => __DIR__ . '/../view/partials/offer-object-selected.phtml',
            'offer-object-modal-selection' => __DIR__ . '/../view/partials/offer-object-modal-selection.phtml',
            "offer-process-selected-objects"=>__DIR__ . '/../view/partials/offer-process-list-object-sniper.phtml',
            // Begin Email templating
            "offer-email-invoice-reminder"=>__DIR__ . '/../view/email/offer-invoice-reminder.phtml',
            "offer-pulsating-button"=>__DIR__ . '/../view/partials/offer-pulse-button.phtml',
            // End Email Templating
            "offer-recommend-insurer"=>__DIR__ . '/../view/partials/offer-recommend-insurer.phtml',
            //Begin Recmmend Ofer form
            
            // End 
            //Messaging Snippet 
            "offer-message-snippet"=>__DIR__ . '/../view/partials/offer-message-snippet.phtml',
            
            // modal
            "offer-preview-details-snippet"=>__DIR__ . '/../view/partials/modal/offer-preview-details-snippet.phtml',
            "offer-form-modal-snippet"=>__DIR__ . '/../view/partials/modal/offer-form-modal-snippet.phtml',
            "offer-form-modal-process-snippet"=>__DIR__ . '/../view/partials/modal/offer-formmodal-process-snippet.phtml',
            
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
        'invokables' => array(
            'Offer\Form\Fieldset\OfferObjectFieldset' => 'Offer\Form\Fieldset\OfferObjectFieldset'
        ),
        'factories' => array(
            'Offer\Form\Fieldset\OfferFieldset' => 'Offer\Form\Fieldset\Factory\OfferFieldsetFactory',
            
            'Offer\Form\OfferInfoForm' => 'Offer\Form\Factory\OfferInfoFormFactory',
            'Offer\Form\OfferObjectForm' => 'Offer\Form\Factory\OfferObjectFormFactory',
            'Offer\Form\OfferPremiumForm' => 'Offer\Form\Factory\OfferPremiumFormFactory',
            'Offer\Form\OfferForm' => 'Offer\Form\Factory\OfferFormFactory',
            "Offer\Form\ReccomendInsurerForm"=>"Offer\Form\Factory\RecomendInsurerFormFactory"
        )
    
    ),
    "view_helpers"=>array(
        'invokables' => array(
            "offer_list_document_helper"=>"Offer\View\Helper\OfferDocumentListViewHelper",
            "offer_all_condition_button"=>"Offer\View\Helper\OfferProcessConditionButton",
            "offer_process_all_object_view"=>"Offer\View\Helper\OfferObjectListViewHelper",
            "offer_process_invoice_button_condition"=>"Offer\View\Helper\OfferProcessInvoiceConditionButton",
            "offer_process_payment_status"=>"Offer\View\Helper\OfferProcessPaymentStatusViewHelper",
            "offer_process_covernote_helper"=>"Offer\View\Helper\OfferProcessCoverNoteViewHelper",
            "offer_manual_payment_helper"=>"Offer\View\Helper\OfferManualPaymentHelper",
            "offer_recommended_insurer_helper"=>"Offer\View\Helper\OfferRecommendedInsurerViewHelper"
        ),
    ),
);

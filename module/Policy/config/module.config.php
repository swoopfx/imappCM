<?php
namespace Policy;

return array(
    'controllers' => array(
        'invokables' => array(
            // 'Policy\Controller\Index' => 'Policy\Controller\IndexController'
        ),
        'factories' => array(
            'Policy\Controller\Index' => 'Policy\Controller\Factory\IndexControllerFactory',
            'Policy\Controller\Policy' => 'Policy\Controller\Factory\PolicyControllerFactory',
            "Policy\Controller\CoverNote" => 'Policy\Controller\Factory\CoverNoteControllerFactory'
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Policy\Service\PolicyService' => 'Policy\Service\Factory\PolicyServiceFactory',
            "Policy\Service\CoverNoteService" => "Policy\Service\Factory\ConerNoteServiceFactory"
        )
    ),
    'router' => array(
        'routes' => array(
            'policy' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/policy',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Policy\Controller',
                        'controller' => 'Policy',
                        'action' => 'all'
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
                            'route' => '[/:action[/:id[/:sess]]]',
                            'constraints' => array(
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'sess' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                
                )
            ),
            
            'cover-note' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/cover-note',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Policy\Controller',
                        'controller' => 'CoverNote',
                        'action' => 'all'
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
                            'route' => '[/:action[/:id[/:sess]]]',
                            'constraints' => array(
                                // 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*',
                                'sess' => '[a-zA-Z0-9_-]*'
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
            'Policy' => __DIR__ . '/../view'
        ),
        'template_map' => array( 
            "edit_policy_form"=>__DIR__ . '/../view/policy/partials/edit-policy-form.phtml',
            "policy_form"=>__DIR__ . '/../view/policy/partials/policy-form.phtml',
            "policy_upload_policy_form_snippet" => __DIR__ . '/../view/policy/partials/policy-upload-policy-form-snippet.phtml',
            "policy_certificate_snippet" => __DIR__ . '/../view/policy/policy/partials/policy-certificate-view-snippet.phtml',
            "policy_certificate_responsive_snippet" => __DIR__ . '/../view/policy/policy/partials/policy-certificate-responsive-view-snippet.phtml',
            "policy-generate-policy-form-snippet" => __DIR__ . '/../view/policy/partials/policy-generate-policy-form-snippet.phtml',
            'policy-my-policy-snipet' => __DIR__ . '/../view/policy/partials/my-policy-snipet.phtml',
            'policy-list-policy-snipet' => __DIR__ . '/../view/policy/partials/policy_list_poliicy_snippet.phtml',
            'policy-my-covernore-snipet' => __DIR__ . '/../view/policy/partials/policy-my-covernote.phtml',
            "policy_covernote_generation_fieldset" => __DIR__ . '/../view/policy/cover-note/partial/policy_covernote_generation_fieldset.phtml',
            "policy_covernote_view_snippet" => __DIR__ . '/../view/policy/cover-note/partial/policy-covernote-view-snippet.phtml',
            "policy_covernote_generation_form" => __DIR__ . '/../view/policy/partials/policy_covernote_generation_form.phtml',
            
            "policy_policy_generation_form" => __DIR__ . '/../view/policy/policy/policy-generation.phtml',
            
            // partialsz
            "policy_policy_generation_form_snipet" => __DIR__ . '/../view/policy/partials/policy-generate-policy-form-snippet.phtml',
            "policy_renew_policy_customer_form" => __DIR__ . '/../view/policy/partials/policy-renew-policy-customer-form.phtml',
            "policy_revoke_fieldset" => __DIR__ . '/../view/policy/partials/policy-revoke-fieldset-snippet.phtml',
            "policy_revoke_form" => __DIR__ . '/../view/policy/partials/policy-revoke-form.phtml',
            "policy_special_terms_form" => __DIR__ . '/../view/policy/partials/policy-special-terms-form.phtml',
            "policy_suspension_info_snippet" => __DIR__ . '/../view/policy/partials/policy-suspension-info.phtml',
            "policy_special_terms_details" => __DIR__ . '/../view/policy/partials/policy-special-terms-details.phtml',
            "policy_status_fieldset_snippet" => __DIR__ . '/../view/policy/partials/policy_status_fieldset_snippet.phtml',
            "policy_premium_payable_fieldset_snippet" => __DIR__ . '/../view/policy/partials/policy_premium_payable_fieldset_snippet.phtml',
            
            // modal
            "policy-policy-hook-renewal-list-snippet" => __DIR__ . '/../view/policy/partials/modal/policy_policy_hook_renewal_list_snippet.phtml',
            "policy-premium-payable-form-snippet" => __DIR__ . '/../view/policy/partials/modal/policy_premium_payable_form_snippet.phtml',
            "policy-status-form-snippet" => __DIR__ . '/../view/policy/partials/modal/policy_status_form_snippet.phtml',
            "policy-modal-view-details-snippet" => __DIR__ . '/../view/policy/partials/modal/policy-view-details-snippet.phtml',
            "policy-modal-policy-certificate-modal" => __DIR__ . '/../view/policy/partials/modal/policy-view-policy-certificate-modal.phtml'
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
    "view_helpers" => array(
        'invokables' => array(
            "covernote_soure_helper" => "Policy\View\Helper\CoverNoteSourceHelper",
            "covernote_service_type_helper" => "Policy\View\Helper\CoverNoteServiceTypeHelper",
            "covernote_specific_service_type_helper" => "Policy\View\Helper\CoverNoteSpecificServiceTypeHelper",
            "policy_all_action_condition" => "Policy\View\Helper\PolicyAllActionCondition",
            "coverNoteName" => "Policy\View\Helper\CoverNoteNameHelper",
            "policy_document_list"=>"Policy\View\Helper\PolicyDocumentListHelper",
            "policyManageActivityHelper"=>"Policy\View\Helper\PolicyManageActivityViewHelper",
        )
    ),
    "form_elements" => array(
        "factories" => array(
//             "Policy\Form\Fieldset\PolicyFloatUploadFeildset"=>"Policy\Form\Fieldset\Factory\PolicyFloatUploadFieldsetFactory",
            "Policy\Form\Fieldset\RenewPolicyFieldset"=>"Policy\Form\Fieldset\Factory\RenewPolicyFieldsetFactory",
            "Policy\Form\Fieldset\PolicyFloatFieldset" => "Policy\Form\Fieldset\Factory\PolicyFloatFieldsetFactory",
            "Policy\Form\Fieldset\CoverNoteFieldset" => "Policy\Form\Fieldset\Factory\CoverNoteFieldsetFactory",
            "Policy\Form\Fieldset\PolicyFieldset" => "Policy\Form\Fieldset\Factory\PolicyFieldsetFactory",
            "Policy\Form\Fieldset\PolicyRevokeFieldset" => "Policy\Form\Fieldset\Factory\PolicyRevokeFieldsetFactory",
            "Policy\Form\Fieldset\PolicySpecialTermsFieldset" => "Policy\Form\Fieldset\Factory\PolicySpecialTermsFirldsetFactory",
            "Policy\Form\Fieldset\PolicyStatusFieldset" => "Policy\Form\Fieldset\Factory\PolicyStatusFieldsetFactory",
            "Policy\Form\Fieldset\PolicyPremiumPayableFieldset" => "Policy\Form\Fieldset\Factory\PolicyPremiumPayableFieldsetFactory",
            
            "Policy\Form\CoverNoteForm" => "Policy\Form\Factory\CoverNoteForFactory",
            "Policy\Form\PolicyForm" => "Policy\Form\Factory\PolicyFormFactory",
            "Policy\Form\Fieldset\UploadPolicyFieldset" => "Policy\Form\Fieldset\Factory\UploadPolicyFieldsetFactory",
            "Policy\Form\UploadPolicyForm" => "Policy\Form\Factory\UploadPolicyFormFactory",
            "Policy\Form\PolicyFloatForm" => "Policy\Form\Factory\PolicyFloatFormFactory",
            "Policy\Form\RenewPolicyForm"=>"Policy\Form\Factory\RenewPolicyFormFactory",
            "Policy\Form\PolicyRevokeForm"=>"Policy\Form\Factory\PolicyRevokeFormFactory",
            "Policy\Form\PolicySpecialTermsForm"=>"Policy\Form\Factory\PolicySpecialTermFormFactory",
            "Policy\Form\PolicyStatusForm"=>"Policy\Form\Factory\PolicyStatusFormFactory",
            "Policy\Form\PolicyPremiumPayableForm"=>"Policy\Form\Factory\PolicyPremiumPayableFormFactory",
        )
    )
);

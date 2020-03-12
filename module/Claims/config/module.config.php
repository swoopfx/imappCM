<?php
namespace Claims;

return array(
    'controllers' => array(
        'invokables' => array(
            //'Claims\Controller\Claims' => 'Claims\Controller\ClaimsController'
        ),
        'factories' => array(
            'Claims\Controller\Claims'=>'Claims\Controller\Factory\ClaimsControllerFactory'
        ),
    ),
    'router' => array(
        'routes' => array(
            'claims' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/claims',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Claims\Controller',
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
                                //'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*',
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
            'Claims' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'claims-all-broker-snipet'=>__DIR__ . '/../view/partials/claims-all-broker-snipet.phtml',
            "claims-processing-snippet"=>__DIR__ . '/../view/partials/modal/claims-processing-snippet.phtml',
            
            
            // Claims form 
            "claims-form-form-snippet"=>__DIR__ . '/../view/partials/form/claim-form-snippet.phtml',
            "claims-form-default-snippet"=>__DIR__ . '/../view/partials/form/claims-form-default-snippet.phtml',
            "claims-form-motor-snipet"=>__DIR__ . '/../view/partials/form/claims-form-motor-snippet.phtml',
            "claims-form-employee-liability-snippet"=>__DIR__ . '/../view/partials/form/claims-form-employee-liability-snippet.phtml',
            "claims-form-cash-in-transit-snipet"=>__DIR__ . '/../view/partials/form/claims-form-cash-in-transit-snippet.phtml',
            "claims-form-git-snipet"=>__DIR__ . '/../view/partials/form/claims-form-git-snippet.phtml',
            "claims-form-burglary-snippet"=>__DIR__ . '/../view/partials/form/claims-form-burglary-snippet.phtml',
            "claims-form-fidelity-gauratee-snippet"=>__DIR__ . '/../view/partials/form/claims-form-fidelity-gauratee-snippet.phtml',
            "claims-form-contract-all-risk-snippet"=>__DIR__ . '/../view/partials/form/claims-form-contract-all-risk-snippet.phtml',
            "claims-form-professional-indemnity-snippet"=>__DIR__ . '/../view/partials/form/claims-form-professional-indemnity-snippet.phtml',
            "claims-form-marine-cargo-snippet"=>__DIR__ . '/../view/partials/form/claims-form-marine-cargo-snippet.phtml',
            "claims-form-fire-loss-snippet"=>__DIR__ . '/../view/partials/form/claims-form-fire-loss-snippet.phtml',
            "claims--approve-claims-form"=>__DIR__ . '/../view/partials/form/claims_approve_claims_form.phtml',
            "claims-form-motor-driver-details-snipet"=>__DIR__ . '/../view/partials/form/claims-form-motor-driver-dettails-snippet.phtml',
            "claims-rejected-claims-form"=>__DIR__ . '/../view/partials/form/claims_rejected_claims_form.phtml',
            
            //Details
            "claims-details-snippet"=>__DIR__ . '/../view/partials/modal/claims-details-snippet.phtml',
            "claims-default-details-snippet"=>__DIR__ . '/../view/partials/modal/claims-default-details-snippet.phtml',
            "claims-motors-details-snippet"=>__DIR__ . '/../view/partials/modal/claims-motor-details-snippet.phtml',
            "claims-details-buglary-snippet"=>__DIR__ . '/../view/partials/modal/claims-details-buglary-snippet.phtml',
            "claims-details-professional-indemnity-snippet"=>__DIR__ . '/../view/partials/modal/claims-details-professional-indemnity-snippet.phtml',
            "claims-marine-cargo-details-snippet"=>__DIR__ . '/../view/partials/modal/claims-marine-cargo-details-snippet.phtml',
            "claims-employee-liability-details-snippet"=>__DIR__ . '/../view/partials/modal/claims-employee-liability-details.phtml',
            "claims-test"=>__DIR__ . '/../view/partials/test.phtml',
            
            // modal
            "claims_export_detals_button"=>__DIR__ . '/../view/partials/modal/claims_export_details_button.phtml',
            "claims_export_form_snippet"=>__DIR__ . '/../view/partials/modal/claims_export_form_snippet.phtml',
            
            // partials
            "claims_ispproved_claims_snippet"=>__DIR__ . '/../view/partials/claims_isaproved_claims_snippet.phtml',
            "claims_is_rejected_claims_snippet"=>__DIR__ . '/../view/partials/claims_is_rejected_claims_snippet.phtml',
            
            
            
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
    ),
    
   'form_elements'=>array(
       'factories'=>array(
           
           "Claims\Form\Fieldset\ClaimsFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsMotorAccidentFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsMotorFieldsetAccidentFactory",
           "Claims\Form\Fieldset\ClaimsDriverDetailsFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsDriverDetailsFactory",
           "Claims\Form\Fieldset\ClaimsCashInTransitFiledset"=>"Claims\Form\Fieldset\Factory\ClaimsCashInTransitFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsGitFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsGitFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsBurglaryFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsBurglaryFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsDefaultFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsDefaultFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsFidelityGaurateeFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsFidelityGaurateeFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsContractorAllRiskFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsContractorAllRiskFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsExportClaimsFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsExportCLaimsFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsApprovedFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsApprovedFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsRejectedFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsRejectFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsMarineCargoFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsMarineCargoFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsEmployerLiabilityFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsEmployerLiabilityFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsFireLossFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsFireLosFieldsetFactory",
           "Claims\Form\Fieldset\ClaimsProfessionalIndemnityFieldset"=>"Claims\Form\Fieldset\Factory\ClaimsProfessionalIndemnityFieldsetFactory",
           
           // Claims Form
           'Claims\Form\ClaimsForm'=>'Claims\Form\Factory\ClaimsFormFactory',
           'Claims\Form\ClaimsBurglaryForm'=>'Claims\Form\Factory\ClaimsBurglaryFormFactory',
           'Claims\Form\ClaimsMotorForm'=>'Claims\Form\Factory\ClaimsMotorFormFactory',
           'Claims\Form\ClaimsDefaultForm'=>'Claims\Form\Factory\ClaimsDefaultFormFactory',
           'Claims\Form\ClaimsCashInTransitForm'=>'Claims\Form\Factory\ClaimsCashInTransitFormFactory',
           'Claims\Form\ClaimsGitForm'=>'Claims\Form\Factory\ClaimsGitFormFactory',
           'Claims\Form\ClaimsFidelityGaurateeForm'=>'Claims\Form\Factory\ClaimsFidelityGaurateeFormFactory',
           'Claims\Form\ClaimsContractorsAllRiskForm'=>'Claims\Form\Factory\ClaimsContractorsAllRiskFormFactory',
           'Claims\Form\ClaimsExportClaimsForm'=>'Claims\Form\Factory\ClaimsExportClaimsFormFactory',
           'Claims\Form\CLaimsApprovedForm'=>'Claims\Form\Factory\ClaimsApprovedFormFactory',
           'Claims\Form\ClaimsRejectedForm'=>'Claims\Form\Factory\ClaimsRejectedFormFactory',
           'Claims\Form\ClaimsMarineCargoForm'=>'Claims\Form\Factory\ClaimsMarineCargoFormFactory',
           'Claims\Form\ClaimsEmployerLiabilityForm'=>'Claims\Form\Factory\ClaimsEmployerLiabilityFormFactory',
           'Claims\Form\ClaimsFireLossForm'=>'Claims\Form\Factory\ClaimsFireLossFormFactory',
           'Claims\Form\ClaimsProfessionalIndemnityForm'=>'Claims\Form\Factory\ClaimsProfessionalIndemnityFormFactory',
           
           
       ),
   ),
    'service_manager' => array(
        'factories' => array(
            'Claims\Service\ClaimsService'=>'Claims\Service\Factory\ClaimsServiceFactory',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            "claimsFormConditionHelper"=>"Claims\View\Helper\ClaimsFormConditionHelper",
            "claimsActionButtonHelper"=>"Claims\View\Helper\ClaimsBrokerActionConditionHelper",
            "claimsFormServiceTypeHelper"=>"Claims\View\Helper\ClaimsFormServiceType",
            "claimsSettledDocumentListHelper"=>"Claims\View\Helper\ClaimsSettledDocumentList",
            "claimsDocumentListHelper"=>"Claims\View\Helper\ClaimsDocumentListHelper",
            "claimsDetailsViewhelper"=>"Claims\View\Helper\ClaimsDetailsViewHelper"
            
        ),
    ),
);

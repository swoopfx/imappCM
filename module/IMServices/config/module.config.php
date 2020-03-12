<?php
namespace IMServices;

return array(
    'controllers' => array(
        'factories' => array(
            'IMServices\Controller\Index' => 'IMServices\Controller\Factory\PortalControllerFactory',
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
    
    'router' => array(
        'routes' => array(
            "insurance_portal" => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/portal',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Object\Controller',
                        'controller' => 'Index',
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
                            'route' => '[/:portalId[/:insurer]]',
                            'constraints' => array(
                                
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'portalId' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'proposal' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'customer' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'inf' => '[a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                   
                    
                )
            )
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
    'service_manager' => array(
        'factories' => array(
            "IMServices\Service\IMService"=>"IMServices\Service\Factory\IMServiceFactory",
        ),
    ),
    'form_elements' => array(
        'factories' => array(
            // Begin Service Form
            "IMServices\Form\OilEnergyForm" => "IMServices\Form\Factory\OilEnergyFormFactory",
            "IMServices\Form\AviationInsuranceForm" => "IMServices\Form\Factory\AviationInsuranceFormFactory",
            "IMServices\Form\BuglaryHouseForm" => "IMServices\Form\Factory\BuglaryHouseFormFactory",
            "IMServices\Form\ContractAllRiskForm" => "IMServices\Form\Factory\ContractAllRiskFormFactory",
            "IMServices\Form\EmployeeLiabilityForm" => "IMServices\Form\Factory\EmployersLiabilityFormFactory",
            "IMServices\Form\FidelityGuarateeForm" => "IMServices\Form\Factory\FidelityGuaranteeFormFactory",
            "IMServices\Form\FirAndSpecialPerilForm" => "IMServices\Form\Factory\FireAndSpecialPerilFormFactory",
            "IMServices\Form\GitForm" => "IMServices\Form\Factory\GitFormFactory",
            "IMServices\Form\GroupLifeForm" => "IMServices\Form\Factory\GroupLifeFormFactory",
            "IMServices\Form\MachineBreakdownForm" => "IMServices\Form\Factory\MachineBreakdownFormFactory",
            "IMServices\Form\MarineCargoForm" => "IMServices\Form\Factory\MarineCargoFormFactory",
            "IMServices\Form\TravelInsuranceForm" => "IMServices\Form\Factory\TravelInsuranceFormFactory",
            "IMServices\Form\AdvancedPaymentBondForm" => "IMServices\Form\Factory\AdvancedPaymentFormFactory",
            "IMServices\Form\HomeInsuranceForm" => "IMServices\Form\Factory\HomeInsuranceFormFactory",
            "IMServices\Form\CashInTransitForm" => "IMServices\Form\Factory\CashInTransitFormFactory",
            "IMServices\Form\CashInSafeForm" => "IMServices\Form\Factory\CashInSafeFormFactory",
            "IMServices\Form\LiveStockFarmInsuranceForm" => "IMServices\Form\Factory\LiveStockFarmInsuranceFormFactory",
            "IMServices\Form\CropAgricInsuranceForm" => "IMServices\Form\Factory\CropAgricInsuranceFormFactory",
            "IMServices\Form\MarineHullForm" => "IMServices\Form\Factory\MarineHullFormFactory",
            "IMServices\Form\OccupiersLiabilityForm" => "IMServices\Form\Factory\OccupiersLiabilityFormFactory",
            "IMServices\Form\MotorInsuranceForm"=>"IMServices\Form\Factory\MotorInsuranceFormFactory",
            "IMServices\Form\BoilerInsuranceForm"=>"IMServices\Form\Factory\BoilerInsuranceFormFactory",
            "IMServices\Form\PersonalAccidentForm"=>"IMServices\Form\Factory\PersonalAccidentFactory",
            "IMServices\Form\PublicLiabilityForm"=>"IMServices\Form\Factory\PublicLiabilityFormFactory",
            "IMServices\Form\ProffesionalIndemnityForm"=>"IMServices\Form\Factory\ProffesionalIndemnityFormFactory",
            "IMServices\Form\DirectorsLiabilityForm"=>"IMServices\Form\Factory\DirectorLiabiltiyFormFactory",
            "IMServices\Form\AgricProductInsuranceForm"=>"IMServices\Form\Factory\AgricProductInsuranceFormFactory",
            "IMServices\Form\LifePolicyForm"=>"IMServices\Form\Factory\LifePolicyFormFactory",
            "IMServices\Form\GroupPersonalAccidentForm"=>"IMServices\Form\Factory\GroupPersonalAccidentFormFactory",
            "IMServices\Form\ElectronicEquipmentForm"=>"IMServices\Form\Factory\ElectronicEquipmentFormFactory",
            "IMServices\Form\WorkmenCompensationForm"=>"IMServices\Form\Factory\WorkmenCompensationFormFactory",
            
            
            // Begin Micro Form 
            "IMServices\Form\GitVehicleListForm"=>"IMServices\Form\Factory\GitVehicleListFormFactory",
            "IMServices\Form\MotorNonStandardForm"=>"IMServices\Form\Factory\MotorNonStandardAccessoryFormFactory",
            "IMServices\Form\ProfessionalIndemnityPartnerDetailsForm"=>"IMServices\Form\Factory\ProfessionalIndemnitypartnerDetailsFormFactory",
            
            
            // Begin Service Fieldset
            "IMServices\Form\Fieldset\OilEnergyFieldset" => "IMServices\Form\Fieldset\Factory\OilEnergyFieldsetFactory",
            "IMServices\Form\Fieldset\AviationInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\AviationInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\FidelityGuarateeFieldset" => "IMServices\Form\Fieldset\Factory\FidelityGuarateeFieldsetFactory",
            "IMServices\Form\Fieldset\BuglaryHouseFieldset" => "IMServices\Form\Fieldset\Factory\BuglaryHouseFieldsetFactory",
            "IMServices\Form\Fieldset\ContractALlRiskFieldset" => "IMServices\Form\Fieldset\Factory\ContractAllRIskFieldsetFactory",
            "IMServices\Form\Fieldset\GitFieldset" => "IMServices\Form\Fieldset\Factory\GitFieldsetFactory",
            "IMServices\Form\Fieldset\EmployerLiabilityFieldset" => "IMServices\Form\Fieldset\Factory\EmployeeLiabilityFieldsetFactory",
            'IMServices\Form\Fieldset\MotorOfferDataFieldset' => 'IMServices\Form\Fieldset\Factory\MotorOfferDataFieldsetFactory',
            'IMServices\Form\Fieldset\MotorOfferGeneralInfoFieldset' => 'IMServices\Form\Fieldset\Factory\MotorOfferGIFieldsetFactory',
            "IMServices\Form\Fieldset\FireAndSpecialPerilFieldset" => "IMServices\Form\Fieldset\Factory\FireAndSpecialPerilFieldsetFactory",
            "IMServices\Form\Fieldset\GroupLifeFieldset" => "IMServices\Form\Fieldset\Factory\GroupLifeFieldsetFactory",
            "IMServices\Form\Fieldset\MachineBreakdownFieldset" => "IMServices\Form\Fieldset\Factory\MachineBreakDownFieldsetFactory",
            "IMServices\Form\Fieldset\MarineCargoFieldset" => "IMServices\Form\Fieldset\Factory\MarineCargoFieldsetFactory",
            "IMServices\Form\Fieldset\TravelInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\TravelInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\AdvancedPaymentBondFieldset" => "IMServices\Form\Fieldset\Factory\AdvancedPaymentBondFieldsetFactory",
            "IMServices\Form\Fieldset\HomeInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\HomeInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\CashInTransitFieldset" => "IMServices\Form\Fieldset\Factory\CashInTransitFieldsetFactory",
            "IMServices\Form\Fieldset\CashInSafeFieldset" => "IMServices\Form\Fieldset\Factory\CashInSafeFieldsetFactory",
            "IMServices\Form\Fieldset\LiveStockFarmInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\LiveStockFarmInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\CropInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\CropInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\HullFieldset" => "IMServices\Form\Fieldset\Factory\HullFieldsetFactory",
            "IMServices\Form\Fieldset\MotorInsuranceFieldset"=>"IMServices\Form\Fieldset\Factory\MotorInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\OccupiersLiabilityFieldset" => "IMServices\Form\Fieldset\Factory\OccupeirsLiabilityFieldsetFactory",
            "IMServices\Form\Fieldset\BoilerInsuranceFieldset" => "IMServices\Form\Fieldset\Factory\BoilerInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\PersonalAccidentFieldset" => "IMServices\Form\Fieldset\Factory\BoilerInsuranceFieldsetFactory",
            "IMServices\Form\Fieldset\FidelityGaurateeEmployeeListFieldset"=>"IMServices\Form\Fieldset\Factory\FidelityGaurateeEmployeeListFieldsetFactory",
            "IMServices\Form\Fieldset\PublicLiabilityFieldset"=>"IMServices\Form\Fieldset\Factory\PublicLiabilityFieldseFactory",
            "IMServices\Form\Fieldset\ProffesionalIndemnityFieldset"=>"IMServices\Form\Fieldset\Factory\ProffessionalIndemnityFieldsetFactory",
            "IMServices\Form\Fieldset\DirectorsLiabilityFieldset"=>"IMServices\Form\Fieldset\Factory\DirectorLiabilityFieldsetFactory",
            "IMServices\Form\Fieldset\AgricProductInsuranceFieldset"=>"IMServices\Form\Fieldset\Factory\AgricProductFieldsetFactory",
            "IMServices\Form\Fieldset\LifePolicyFieldset"=>"IMServices\Form\Fieldset\Factory\LifePolicyFieldsetFactory",
            "IMServices\Form\Fieldset\GroupPersonalAccidentFieldset"=>"IMServices\Form\Fieldset\Factory\GroupPersonalAccidentFieldsetFactory",
            "IMServices\Form\Fieldset\ElectronicEquipmentFieldset"=>"IMServices\Form\Fieldset\Factory\ElectronicEquipmentFieldsetFactory",
            "IMServices\Form\Fieldset\WorkmenCompensationFieldset"=>"IMServices\Form\Fieldset\Factory\WorkmenCompensationFeildsetFactory",
            
            // Begin Micro Fiedlset
            "IMServices\Form\Fieldset\GitVehicleDetailsFieldset" => "IMServices\Form\Fieldset\Factory\GitVehicleDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\AviationinsurancePilotDetailsFieldset" => "IMServices\Form\Fieldset\Factory\AviationinsurancePilotDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\MotorNonStandardAccesoryFieldset" => "IMServices\Form\Fieldset\Factory\MotorNonStandardAccesoryFieldsetFactory",
            "IMServices\Form\Fieldset\ProfessionalIndemnityParnerDetailsFieldset" => "IMServices\Form\Fieldset\Factory\ProfessionalIndemnityPartnersDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\BoilerCoverDetailsFeildset" => "IMServices\Form\Fieldset\Factory\BoilerCoverDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\BuglarySafeDetailsFieldset" => "IMServices\Form\Fieldset\Factory\BuglarySafeDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\ContractAllRiskValueListFieldset" => "IMServices\Form\Fieldset\Factory\ContractAllRIskValueListFieldsetFactory",
            "IMServices\Form\Fieldset\AgricPropertyInsuranceListFieldset"=>"IMServices\Form\Fieldset\Factory\AgricPropertyInsuranceListFieldsetFactory",
            "IMServices\Form\Fieldset\GroupPersonalFixedDetailsFieldset"=>"IMServices\Form\Fieldset\Factory\GroupPersonalFixedDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\GroupPersonalWagesDetailsFieldset"=>"IMServices\Form\Fieldset\Factory\GroupPersonalWagesDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\CropInsuranceStafffDetailsFieldset"=>"IMServices\Form\Fieldset\Factory\CropInsuranceStafffDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\CropAgricCropDetailsFieldset"=>"IMServices\Form\Fieldset\Factory\CropAgricCropDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\LivestockInsuredListFieldset"=>"IMServices\Form\Fieldset\Factory\LivestockInsuredListFieldsetFactory",
            "IMServices\Form\Fieldset\GroupLifeEmployeeListFieldset"=>"IMServices\Form\Fieldset\Factory\GroupLifeEmployeeListFieldsetFactory",
            "IMServices\Form\Fieldset\WorkmenDecreeListFieldset"=>"IMServices\Form\Fieldset\Factory\WorkmenDecreeListFieldsetFactory",
            "IMServices\Form\Fieldset\EmployeeLiabilityDEtailsFieldset"=>"IMServices\Form\Fieldset\Factory\EmployeeLiabilityDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\FidelityGaurateeEmployeeListFieldset"=>"IMServices\Form\Fieldset\Factory\FidelityGaurateeEmployeeListFieldsetFactory",
            "IMServices\Form\Fieldset\HomeHouseholdGoodsFieldset"=>"IMServices\Form\Fieldset\Factory\HomeHouseholdGoodsFieldsetFactory",
            "IMServices\Form\Fieldset\HomeHpuseValuablesFieldset"=>"IMServices\Form\Fieldset\Factory\HomehouseValuableFieldsetFactory",
            "IMServices\Form\Fieldset\OccupierLiabilityStaffFieldset"=>"IMServices\Form\Fieldset\Factory\OccupierLiabilityStaffFieldsetFactory",
            "IMServices\Form\Fieldset\OccupiersLiabilityFamiliyFieldset"=>"IMServices\Form\Fieldset\Factory\OccupiersLiabilityFamiliyFieldsetFactory",
            "IMServices\Form\Fieldset\PublicLiabityEmployeeDetailsFieldset"=>"IMServices\Form\Fieldset\Factory\PublicLiabilityEmployeeDetailsFieldsetFactory",
            "IMServices\Form\Fieldset\WorkmenContractorsListFieldset"=>"IMServices\Form\Fieldset\Factory\WorkmenContractorsListFieldsetFactory",
            
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            "im_service_form" => "IMServices\View\Helper\CoverFormHelper",
            "coverDetailsHelper"=>"IMServices\View\Helper\CoverDetailsHelper",
            "trueFalseHelper"=>"IMServices\View\Helper\TrueFalseHelper"
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            "im_service_form_snippet" => __DIR__ . '/../view/im-services/form/im-service-form-snippet.phtml',
            
            // Begin Feildset
            "motor_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/motor_insurance_fieldset.phtml',
            "advanced_payment_bond_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/advanced_payment_bond_fieldset.phtml',
            "aviation_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/aviation_insurance_fieldset.phtml',
            "oil_energy_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/oil_energy_insurance_fieldset.phtml',
            "boiler_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/boiler_insurance_fieldset.phtml',
            "buglary_house_fire_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/buglary_house_fieldset.phtml',
            "contract_all_risk_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/contract_all_risk_fieldset.phtml',
            "employer_liability_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/employer_liability_fieldset.phtml',
            "fidelity_guarantee_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/fidelity_guaratee_feildset.phtml',
            "fire_special_peril_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/fire_special_peril_fieldset.phtml',
            "git_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/git_fieldset.phtml',
            "group_life_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/group_life_fieldset.phtml',
            "machine_breakdown_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/machine_breakdown_fieldset.phtml',
            "marine_cargo_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/marine_cargo_fieldset.phtml',
            "travel_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/travel_insurance_fieldset.phtml',
            "home_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/home_insurance_fieldset.phtml',
            "cash_in_transit_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/cash_in_transit_fieldset.phtml',
            "cash_in_safe_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/cash_in_safe_fieldset.phtml',
            "live_stock_farm_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/live_stock_farm_insurance_fieldset.phtml',
            "crop_agric_insurance_fieldset" => __DIR__ . '/../view/im-services/form/fieldset/crop_agric_insurance_fieldset.phtml',
            "occupiers_liability_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/occupiers_liability_fieldset.phtml',
            "marine_hull_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/marine_hull_fieldset.phtml',
            "personal_accident_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/personal_accident_fieldset.phtml',
            "public_liability_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/public_liability_fieldset.phtml',
            "proffesional_indemnity_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/proffesional_indemnity_fieldset.phtml',
            "director_liability_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/director_liability_fieldset.phtml',
            "agric_property_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/agric_property_insurance_fieldset.phtml',
            "life_policy_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/life_policy_fieldset.phtml',
            "group_personal_accident_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/group_personal_accident_fieldset.phtml',
            "electronic_computer_equipment_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/electronic_computer_equipment_fieldset.phtml',
            "workmen_compensation_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/workmen_compensation_fieldset.phtml',
            
            
            // Beigin sub Fieldset.... This provide trmplate for One to many form fields 
            "git_vehicle_list_fiedlset"=>__DIR__ . '/../view/im-services/form/fieldset/git_vehicle_list_fieldset.phtml',
            "motor_non_standard_fiedlset"=>__DIR__ . '/../view/im-services/form/fieldset/motor_non_standard_fieldset.phtml',
            "professional_indemnity_partner_details_fiedlset"=>__DIR__ . '/../view/im-services/form/fieldset/professional_indemnity_partners_details_fieldset.phtml',
            "boiler_cover_details_fiedlset"=>__DIR__ . '/../view/im-services/form/fieldset/boiler_cover_details_fieldset.phtml',
            "aviation_pilot_details_fiedlset"=>__DIR__ . '/../view/im-services/form/fieldset/aviation_pilot_details_fieldset.phtml',
            "buglary_safe_details_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/buglary_safedetails_feildset.phtml',
            "contractor_all_risk_value_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/contractor_all_risk_value_list_fieldset.phtml',
            "agric_product_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/agric_property_list_fieldset.phtml',
            "group_personal_fixed_details_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/group_personal_fixed_details_fieldset.phtml',
            "group_personal_wages_details_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/group_personal_wages_details_fieldset.phtml',
            "crop_staff_details_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/crop_staff_details_fieldset.phtml',
            "crop_agric_details_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/crop_agric_list_fieldset.phtml',
            "livestock-insured_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/livestock_insured_list_fieldset.phtml',
            "group_life_staff_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/group_life_staff_fieldset.phtml',
            "workmen_decree_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/workmen_compensation_decree_list_fieldset.phtml',
            "employee_liability_detail_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/employee_liability_detail_fieldset.phtml',
            "fidelity_gauratee_employee_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/fidelity_guarantee_employee_list_fieldset.phtml',
            "home_goods_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/home_goods_list_fieldset.phtml',
            "home_valuables_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/home_valuables_list_fieldset.phtml',
            "occupier_liability_staff_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/occupiers_liability_staff_fieldset.phtml',
            "occupier_liability_family_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/occupier_liability_family_fieldset.phtml',
            "public_liability_employee_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/public_liability_employee_feildset.phtml',
            "workmen_contractor_list_fieldset"=>__DIR__ . '/../view/im-services/form/fieldset/workmen_contrator_list_fieldset.phtml',
            
            
            // Begin Cover Details  this provides template for submitted cover details
            "get_cover_details_modal"=>__DIR__ . '/../view/im-services/partials/modal/get_cover_details_modal_snippet.phtml',
            "motor_details"=>__DIR__ . '/../view/im-services/partials/modal/details/motor_details.phtml',
            'cash_in_transit_details'=>__DIR__ . '/../view/im-services/partials/modal/details/cash_in_transit_details.phtml',
            'burglary_details'=>__DIR__ . '/../view/im-services/partials/modal/details/burglary_details.phtml',
            'agric_property_details'=>__DIR__ . '/../view/im-services/partials/modal/details/agric_property_details.phtml',
            'life_policy_details'=>__DIR__ . '/../view/im-services/partials/modal/details/life_policy_details.phtml',
            'group_personal_accident_details'=>__DIR__ . '/../view/im-services/partials/modal/details/group_personal_accident_details.phtml',
            'agric_crop_details'=>__DIR__ . '/../view/im-services/partials/modal/details/agric_crop_details.phtml',
            'agric_livestock_details'=>__DIR__ . '/../view/im-services/partials/modal/details/agric_livestock_details.phtml',
            'oil_energy_details'=>__DIR__ . '/../view/im-services/partials/modal/details/oil_energy_details.phtml',
            'group_life_details'=>__DIR__ . '/../view/im-services/partials/modal/details/group_life_details.phtml',
            'aviation_details'=>__DIR__ . '/../view/im-services/partials/modal/details/aviation_details.phtml',
            'electonic_equipment_details'=>__DIR__ . '/../view/im-services/partials/modal/details/electronic_equipment_details.phtml',
            'workmen_compensation_details'=>__DIR__ . '/../view/im-services/partials/modal/details/workmen_compensation_details.phtml',
            'boiler_details'=>__DIR__ . '/../view/im-services/partials/modal/details/boiler_details.phtml',
            'cash_in_safe_details'=>__DIR__ . '/../view/im-services/partials/modal/details/cash_in_safe_details.phtml',
            'contract_all_risk_details'=>__DIR__ . '/../view/im-services/partials/modal/details/contract_all_risk_details.phtml',
            'employee_liability_details'=>__DIR__ . '/../view/im-services/partials/modal/details/employee_liability_details.phtml',
            'fidelity_guarantee_details'=>__DIR__ . '/../view/im-services/partials/modal/details/fidelity_guarantee_details.phtml',
            'fire_special_peril_details'=>__DIR__ . '/../view/im-services/partials/modal/details/fire_special_peril_details.phtml',
            'git_details'=>__DIR__ . '/../view/im-services/partials/modal/details/git_details.phtml',
            'machinery_breakdown_details'=>__DIR__ . '/../view/im-services/partials/modal/details/machine_breakdown_details.phtml',
            'marine_cargo_details'=>__DIR__ . '/../view/im-services/partials/modal/details/marine_cago_details.phtml',
            'marine_hull_details'=>__DIR__ . '/../view/im-services/partials/modal/details/marine_hull_details.phtml',
            'occupier_liability_details'=>__DIR__ . '/../view/im-services/partials/modal/details/occupier_liability_details.phtml',
            'professional_indemnity_details'=>__DIR__ . '/../view/im-services/partials/modal/details/professional_indemnity_details.phtml',
            'public_liability_details'=>__DIR__ . '/../view/im-services/partials/modal/details/public_liability_details.phtml',
            'travel_insurance_details'=>__DIR__ . '/../view/im-services/partials/modal/details/travel_insurance_details.phtml',
            
            
            // Inner Micro 
            "imservice_motor_non_standard_inner"=>__DIR__ . '/../view/im-services/form/micro/imservice_motor_non_standard_inner.phtml',
            
            
        
        )
    )
);
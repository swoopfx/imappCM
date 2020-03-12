<?php
namespace IMServices\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Service\IMService;

/**
 * This class displays coverspecific form based on specific service
 *
 * @author otaba
 *        
 */
class CoverFormHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($coverId, $form)
    {
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        // $formManager = $serviceLocator->get("FormElementManager");
        $viewManager = $serviceLocator->get("ViewHelperManager");
        $partial = $viewManager->get("partial");
        
        switch ($coverId) {
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
                $form = "<h4>LIVE STOCK (AGRIC INSURANCE) </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "live_stock_farm_insurance_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
                $form = "<h4>CROP INSURANCE (AGRIC INSURANCE) </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "crop_agric_insurance_fieldset"
                ));
                return $form;
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
                $form = "<h4>MOTOR INSURANCE</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "motor_insurance_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
                // $fieldset = $partial("aviation_insurance_fieldset", array(
                // "form" => $avaiationForm
                // ));
                $form = "<h4>AVIATION INSURANCE</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "aviation_insurance_fieldset"
                ));
                return $form;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
                $form = "<h4>AGRIC PROPERTY & PRODUCT </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "agric_property_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                $form = "<h4>BUGLARY HOUSE BREAKING INSURANCE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "buglary_house_fire_fieldset"
                ));
                return $form;
                break;
            case IMService::IM_SPECIFIC_SERVICE_BOILER:
                $form = "<h4>BIOLER INSURANCE</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "boiler_insurance_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                
                $form = "<h4>CONTRACT ALL RISK</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "contract_all_risk_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                $form = "<h4>DIRECTORS/OFFICERS LIABILITY</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "director_liability_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_THIRD_PARTY:
                $form = "<h4>ERECTION ALL RISK</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "contract_all_risk_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                $form = "<h4>CONTRACT ALL RISK</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "contract_all_risk_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                $form = "<h4>EMPLOYERS LIABILITY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "employer_liability_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
                $form = "<h4>ELECTRONIC /COMPUTER EQUIPMENT</h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "electronic_computer_equipment_fieldset"
                ));
                return $form;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                
                $form = "<h4>FIDELITY GUARANTEE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "fidelity_guarantee_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                $form = "<h4>FIRE AND SPECIAL PERIL </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "fire_special_peril_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
                $form = "<h4>GOODS IN TRANSIT </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "git_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE:
                $form = "<h4>GROUP LIFE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "group_life_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT:
            case IMService::IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT:
                
                $form = "<h4>GROUP PERSONAL ACCIDENT </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "group_personal_accident_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
                $form = "<h4>MACHINE BREAKDOWN </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "machine_breakdown_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY:
                $form = "<h4>OIL/GAS/ENERGY INSURANCE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "oil_energy_insurance_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PLANT_ALL_RISK:
                // TODO change all the label to PLant instead of machine
                $form = "<h4>PLANT ALL RISK </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "machine_breakdown_fieldset"
                ));
                return $form;
                break;
            
            // case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
            // $form = "<h4>ELECTRONIC EQUIPMENT ALL RISK (Material Damage) </h4><hr>" . $partial("im_service_form_snippet", array(
            // "form" => $form,
            // "formFields" => "machine_breakdown_fieldset"
            // ));
            // return $form;
            // break;
            
            /**
             * <p>On the buildings of the Private Dwelling house and all the domestic offices, stables,
             * garages and outbuildings being on the same premises
             * and used in connection therewith including landlord’s fixtures and fittings therein or thereon and the walls, gates and fences around and
             * pertaining thereto.
             * Insurance is against loss or damage caused by Fire, Lightning, Explosion, Bursting or Overflowing of Water Tanks or pipes,
             * Impact by Vehicles or aircraft, loss of Rent, etc. (Full Details available on the Policy)</p>
             */
            case IMService::IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE:
                $form = "<h4>COMPREHENSIVE HOME/HOUSEHOLD</h4><hr> " . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "home_insurance_fieldset"
                ));
                return $form;
                break;
            case IMService::IM_SPECIFIC_SERVICE_LIFE_ASSURANCE:
                $form = "<h4>LIFE ASSURANCE</h4><hr> " . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "life_policy_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                
                $form = "<h4>MARINE CARGO </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "marine_cargo_fieldset"
                ));
                return $form;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE:
                $form = "<h4>TRAVEL INSURANCE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "travel_insurance_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ADVANCE_PAYMENT_BOND:
                
                $form = "<h4>ADVANCED PAYMENT BOND </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "advanced_payment_bond_fieldset"
                ));
                return $form;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                $form = "<h4>CASH IN TRANSIT </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "cash_in_transit_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
                $form = "<h4>CASH IN SAFE </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "cash_in_safe_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_HULL_YACHT:
            case IMService::IM_SPECIFIC_SERVICE_HULL_FISHING_VESSEL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_PORT_RISK:
            case IMService::IM_SPECIFIC_SERVICE_HULL_TIME_HULL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_SPEED_BOAT:
            case IMService::IM_SPECIFIC_SERVICE_HULL_VOYAGE_CLAUSE:
                $form = "<h4>MARINE HULL AND MACHINERY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "marine_hull_fieldset"
                ));
                return $form;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY:
                $form = "<h4>OCCUPIERS LIABILITY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "occupiers_liability_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT:
                $form = "<h4>PERSONAL ACCIDENT LIABILITY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "personal_accident_fieldset"
                ));
                return $form;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY:
                $form = "<h4>PUBLIC LIABILITY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "public_liability_fieldset"
                ));
                return $form;
                break;
            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                $form = "<h4>PROFFESIONAL INDEMNITY </h4><hr>" . $partial("im_service_form_snippet", array(
                    "form" => $form,
                    "formFields" => "proffesional_indemnity_fieldset"
                ));
                return $form;
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_WORKMEN_COMPENSATION :
                $form = "<h4>WORKMEN COMPENSATION </h4><hr>" . $partial("im_service_form_snippet", array(
                "form" => $form,
                "formFields" => "workmen_compensation_fieldset"
                    ));
                return $form;
                break;
            
            // case IMService::IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE:
            // $form = "<h4>COMPREHENSIVE HOME INSURANCE </h4><hr>" . $partial("im_service_form_snippet", array(
            // "form" => $cropAgricInsuranceForm,
            // "formFields" => "crop_agric_insurance_fieldset"
            // ));
            // return $form;
            // break;
        }
    }
    
    // private function formFrame($form, $string){
    // $serviceLocator = $this->getServiceLocator()->getServiceLocator();
    // $viewManager = $serviceLocator->get("ViewHelperManager");
    // $form->prepare();
    // $forme = $vie;
    // }
}


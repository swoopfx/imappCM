<?php
namespace IMServices\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Entity\CoverDetails;
use IMServices\Service\IMService;

/**
 *
 * @author otaba
 *        
 */
class CoverDetailsHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

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

    public function __invoke($serviceId)
    {
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        $viewManager = $serviceLocator->get("ViewHelperManager");
        $partialViewHelper = $viewManager->get("partial");
        $coverEntity = new CoverDetails();
        $url = $viewManager->get("url");
        $json = array(
            "type" => "standard"
        );
        $link = $url("proposal/default", array(
            "action" => "coverdetailsmodal"
        ));
        $ul = "<ul class='nav navbar-right panel_toolbox'>
			
			<li class='dropdown'><a href='#' class='dropdown-toggle'
				data-toggle='dropdown' role='button' aria-expanded='false'><i
					class='fa fa-wrench'></i></a>
				<ul class='dropdown-menu' role='menu'>
					<li><a id='btn2'  class='ajax_element'
					data-json='" . json_encode($json) . "' data-href='" . $link . "'>Edit Cover Details</a></li>
					
				</ul></li>
			
		</ul>";
        
        switch ($serviceId) {
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			AGRIC CROP INSURANCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->agriccropDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_GENERAL:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			AGRIC LIVESTOCK INSURANCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->agriclivestockdetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			AGRIC PROPERTY & PRODUCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->agricPropertyDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Aviation Insurance
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->aviationDetails($partialViewHelper);
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_BOILER:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Boiler Insurance
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->boilerdetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_BUILDERS_LIABILITY:
                // return $coverEntity->get
                // return $string.$this->boilerdetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			BUGLARY HOUSE BREAKING
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->burglaryDetails($partialViewHelper);
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_BOND:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Cash In Safe
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->cashInSafeDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Cash In Transit
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->cashInTransitDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONSEQUENTIAL_LOSS:
                return $coverEntity->getConsequentialLoss();
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			ELECTRONIC / COMPUTER EQUIPMENT
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->contractAllRiskDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                // return $coverEntity->get
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			ELECTRONIC / COMPUTER EQUIPMENT
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->electonicEquipment($partialViewHelper);
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			EMLPOYERS LIABILITY
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->employeeLiabilityDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_THIRD_PARTY:
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			FIDELITY GUARANTEE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->fidelityguarateeDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_BUGLARY:
                // return $coverEntity->getFireNSpecialPeril();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                // return $coverEntity->getFireNSpecialPeril();
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			FIDELITY GUARANTEE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->fireSpecialPerilDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
                
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			GIT 
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->gitDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			LIFE ASSURANCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->grouplifedetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT:
            case IMService::IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Group Personal Accident
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->groupPersonalAccidentDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE:
                return $coverEntity->getHomeProperty();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_HULL_FISHING_VESSEL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_PORT_RISK:
            case IMService::IM_SPECIFIC_SERVICE_HULL_SPEED_BOAT:
            case IMService::IM_SPECIFIC_SERVICE_HULL_TIME_HULL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_VOYAGE_CLAUSE:
            case IMService::IM_SPECIFIC_SERVICE_HULL_YACHT:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			MARINE HULL & MACHINERY
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->marineHullDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_LIFE_ASSURANCE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			LIFE ASSURANCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->lifePolicyDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			MACHINE BREAKDOWN
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->machineryBreakDownDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_LOSS_PROFIT:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
            
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			MARINE CARGO
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->marineCargoDetails($partialViewHelper);
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MORTGAGE_ASSURANCE:
                break;
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			Motor Cover Details 
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->motorDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			OCCUPIERS LIABILITY
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->occupiersLiability($partialViewHelper);
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			OIL/ENERGY INSURANCE
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->oilenergydetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_PERFORMANCE_BOND:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT:
                return $coverEntity->getPersonalAccident();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PLANT_ALL_RISK:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			PLANT ALL RISK
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->machineryBreakDownDetails($partialViewHelper);
                break;
            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			PROFESSIONAL INDEMNITY
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->professionalIndemnity($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY:
                
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			PROFESSIONAL INDEMNITY
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->publiLiabilityDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			TRAVEL INSURANCE 
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string.$this->travelInsuranceDetails($partialViewHelper);
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_WORKMEN_COMPENSATION:
                $string = "<div class='x_panel'>
	<div class='x_title'>
		<h2>
			WORKMEN COMPENSATION
		</h2>
		" . $ul . "
		<div class='clearfix'></div>
	</div>";
                return $string . $this->workmenCompensation($partialViewHelper);
                break;
            default:
                break;
        }
    }

    private function agriccropDetails($partial)
    {
        return $partial("agric_crop_details");
    }

    private function motorDetails($partial)
    {
        // $coverEntity = new CoverDetails();
        return $partial("motor_details");
        // , array("motorEntity"=>$coverEntity->getMotorInsurance())
    }

    private function cashInTransitDetails($partials)
    {
        return $partials("cash_in_transit_details");
    }

    private function burglaryDetails($partials)
    {
        return $partials("burglary_details");
    }

    private function agricPropertyDetails($partial)
    {
        return $partial("agric_property_details");
    }

    private function lifePolicyDetails($partial)
    {
        return $partial("life_policy_details");
    }

    private function groupPersonalAccidentDetails($partials)
    {
        return $partials("group_personal_accident_details");
    }

    private function agriclivestockdetails($partial)
    {
        return $partial("agric_livestock_details");
    }

    private function oilenergydetails($partial)
    {
        return $partial("oil_energy_details");
    }

    private function grouplifedetails($partials)
    {
        return $partials("group_life_details");
    }

    private function aviationDetails($partials)
    {
        return $partials("aviation_details");
    }

    private function electonicEquipment($partial)
    {
        return $partial("electonic_equipment_details");
    }

    private function workmenCompensation($partial)
    {
        return $partial("workmen_compensation_details");
    }

    private function boilerdetails($partial)
    {
        return $partial("boiler_details");
    }

    private function cashInSafeDetails($partial)
    {
        return $partial("cash_in_safe_details");
    }

    private function contractAllRiskDetails($partial)
    {
        return $partial("contract_all_risk_details");
    }

    private function employeeLiabilityDetails($partial)
    {
        return $partial("employee_liability_details");
    }

    private function fidelityguarateeDetails($partial)
    {
        return $partial("fidelity_guarantee_details");
    }

    private function fireSpecialPerilDetails($partial)
    {
        return $partial("fire_special_peril_details");
    }

    private function gitDetails($partial)
    {
        return $partial("git_details");
    }

    private function machineryBreakDownDetails($partial)
    {
        return $partial("machinery_breakdown_details");
    }

    private function marineCargoDetails($partial)
    {
        return $partial("marine_cargo_details");
    }

    private function marineHullDetails($partial)
    {
        return $partial("marine_hull_details");
    }

    private function occupiersLiability($partial)
    {
        return $partial("occupier_liability_details");
    }

    private function professionalIndemnity($partial)
    {
        return $partial("professional_indemnity_details");
    }

    private function publiLiabilityDetails($partials)
    {
        return $partials("public_liability_details");
    }
    
    private function travelInsuranceDetails($partials){
        return $partials("travel_insurance_details");
    }
}


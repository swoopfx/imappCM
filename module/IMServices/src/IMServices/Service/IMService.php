<?php
namespace IMServices\Service;

use IMServices\Entity\MotorData;
use IMServices\Entity\CropAgricInsurance;
use Zend\Session\Container;
use IMServices\Entity\LiveStockFarmInsurance;
use IMServices\Entity\CoverDetails;
use GeneralServicer\Entity\Portal;

/**
 *
 * @author otaba
 *        
 */
class IMService
{

    const IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR = 11;

    const IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR = 12;

    const IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT = 10;

    const IM_SPECIFIC_SERVICE_LIFE_CREDIT_LIFE_PLAN = 201;

    const IM_SPECIFIC_SERVICE_LIFE_CHILDREN_EDUCATION = 203;

    const IM_SPECIFIC_SERVICE_LIFE_ASSURANCE = 204;

    const IM_SPECIFIC_SERVICE_PROTECTION_PLAN = 206;

    const IM_SPECIFIC_SERVICE_MORTGAGE_ASSURANCE = 208;

    const IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE = 301;

    const IM_SPECIFIC_SERVICE_TUITION_PROTECTION = 302;

    const IM_SPECIFIC_SERVICE_GROUP_CREDIT_LIFE = 303;

    const IM_SPECIFIC_SERVICE_WELFARE_INSURANCE = 305;

    const IM_SPECIFIC_SERVICE_STAFF_GRATUITY_DEPOSIT = 306;

    const IM_SPECIFIC_SERVICE_AVIATION_INSURANCE = 401;

    const IM_SPECIFIC_SERVICE_PERFORMANCE_BOND = 451;

    const IM_SPECIFIC_SERVICE_ADVANCE_PAYMENT_BOND = 452;

    const IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK = 44;

    const IM_SPECIFIC_SERVICE_AGRIC_CROP = 42;

    const IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE = 45;

    const IM_SPECIFIC_SERVICE_AGRIC_GENERAL = 49;

    const IM_SPECIFIC_SERVICE_BOILER = 461;

    const IM_SPECIFIC_SERVICE_CASH_BOND = 453;

    const IM_SPECIFIC_SERVICE_BUILDERS_LIABILITY = 491;

    const IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING = 531;

    const IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT = 571;

    const IM_SPECIFIC_SERVICE_CASH_IN_SAFE = 573;

    const IM_SPECIFIC_SERVICE_CONSEQUENTIAL_LOSS = 591;

    const IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK = 612;
    
    const IM_SPECIFIC_SERVICE_CONTENT_OFFICE = 601;
    
    const IM_SPECIFIC_SERVICE_CONTENT_SHOP = 603;
    
    const IM_SPECIFIC_SERVICE_CONTENT_HOME = 605;

    const IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE = 614;

    const IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY = 617;

    const IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY = 621;

    const IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE = 641;

    // const IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_
    const IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA = 642;

    const IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST = 643;

    const IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY = 671;

    const IM_SPECIFIC_SERVICE_ERECTION_MATERIAL_DAMAGE = 701;

    const IM_SPECIFIC_SERVICE_ERECTION_THIRD_PARTY = 702;

    const IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE = 711;

    // const IM_SPECIFIC_SERVICE_FIDELITY_POSITION_BASIS = 712;
    
    // const IM_SPECIFIC_SERVICE_FIDELITY_BLANKET_BASIS = 713;
    const IM_SPECIFIC_SERVICE_FIRE_BUGLARY = 731;

    const IM_SPECIFIC_SERVICE_FIRE_PERIL = 751;

    const IM_SPECIFIC_SERVICE_GIT_ALL_RISK = 771;

    const IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER = 772;
    
    const IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT = 781;
    
    const IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT = 782;

    const IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE = 791;
    
    const IM_SPECIFIC_SERVICE_HOUSE_OWNER_COMPREHENSIVE = 801;

    const IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN = 811;

    const IM_SPECIFIC_SERVICE_MACHINE_LOSS_PROFIT = 831;

    const IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A = 851;

    const IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B = 852;

    const IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C = 853;

    const IM_SPECIFIC_SERVICE_HULL_FISHING_VESSEL = 871;

    const IM_SPECIFIC_SERVICE_HULL_YACHT = 872;

    const IM_SPECIFIC_SERVICE_HULL_VOYAGE_CLAUSE = 874;

    const IM_SPECIFIC_SERVICE_HULL_PORT_RISK = 875;

    const IM_SPECIFIC_SERVICE_HULL_TIME_HULL = 873;

    const IM_SPECIFIC_SERVICE_HULL_SPEED_BOAT = 876;

    const IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY = 891;

    const IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT = 901;

    const IM_SPECIFIC_SERVICE_PLANT_ALL_RISK = 921;

    const IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY = 941;

    const IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY = 971;

    const IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE = 1011;
    
    const IM_SPECIFIC_SERVICE_WORKMEN_COMPENSATION = 2301;

    const IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY = 92;

    private $formManager;

    private $entityManager;
    
    private $generalService;

    private $serviceId;

    private $entity;

    private $data;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * This function hydrate the whole cover details
     *
     * @return boolean
     */
    public function coverHydrator()
    {
        // $isHydrated = FALSE;
        $proposalCoverSession = new Container("proposal_cover_session");
        $coverId = $proposalCoverSession->coverId;
        switch ($coverId) {
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                return $this->hydrateMotor();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
                
                return $this->hydrateCropInsurance();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
                
                return $this->hydrateLivestock();
                break;
        }
    }

    public function mainServiceCondition($coverEntity)
    {
        $serviceId = $this->serviceId;
        $coverEntity = new CoverDetails();
        switch ($serviceId) {
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                return $coverEntity->getMotorInsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
                return $coverEntity->getCropAgricIinsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_GENERAL:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
                return $coverEntity->getLivestockAgricInsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
                // return $coverEntity->
                $coverEntity->getAgricPropertyInsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
                return $coverEntity->getAviationInsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_BOILER:
                return $coverEntity->getBoilerInsurance();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_BUILDERS_LIABILITY:
                // return $coverEntity->get
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
                return $coverEntity->getBuglary();
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_BOND:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
                return $coverEntity->getCashInSafeInsurance();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                return $coverEntity->getCashInTransitInsurance();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONSEQUENTIAL_LOSS:
                return $coverEntity->getConsequentialLoss();
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                return $coverEntity->getContractAllRisk();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
                break;
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
                break;
            case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                // return $coverEntity->get
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
                return $coverEntity->getEmployersLiability();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_MATERIAL_DAMAGE:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_THIRD_PARTY:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                return $coverEntity->getFidelityGaruantee();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_BUGLARY:
                // return $coverEntity->getFireNSpecialPeril();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                return $coverEntity->getFireNSpecialPeril();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
                return $coverEntity->getGit();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE:
                return $coverEntity->getGroupLife();
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT:
            case IMService::IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT:
                return $coverEntity->getGroupPersonalAccident();
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
                return $coverEntity->getMarineHull();
                break;
            case IMService::IM_SPECIFIC_SERVICE_LIFE_ASSURANCE:
                return $coverEntity->getLifePolicy();
                break;
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_LOSS_PROFIT:
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                return $coverEntity->getMarineCargo();
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MORTGAGE_ASSURANCE:
                break;
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
                return $coverEntity->getMotorInsurance();
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY:
//                 return $coverEntity->get
                break;
            case IMService::IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY:
                return $coverEntity->getOilEnergyInsurance();
                break;
            case IMService::IM_SPECIFIC_SERVICE_PERFORMANCE_BOND:
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT:
                return $coverEntity->getPersonalAccident();
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_PLANT_ALL_RISK:
                return $coverEntity->getMachineryBreakdown();
                break;
            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                return $coverEntity->getProfessionalIndemnity();
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY:
                return $coverEntity->getPublicLiability();
                break; 
                
            case IMService::IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE:
                return $coverEntity->getTravelInsurance();
                break;
            default:
                break;
        }
    }

    /**
     * This function hydrates motor insurance
     */
    private function hydrateMotor()
    {
        $em = $this->entityManager;
        $motorEntity = $this->entity;
        $data = $this->data;
        
        if ($motorEntity == NULL) {
            $motorEntity = new MotorData();
        }
        // $motorEntity->setOwner($data->getOwner())
        // ->setIsSoleOwner($data->getIsSoleOwner())
        // ->setIsLockedUp($data->getIsLockedUp())
        // ->setIsSafetyDevice($data->getIsSafetyDevice())
        // ->setIsDriverLicense($data->getIsDriverLicense())
        // ->setIsPreviousClaim($data->getIsPreviousCLaim())
        // ->setIsPreviousDecline($data->getIsPreviousDecline())
        // ->setDeclineDetails($data->getDeclineDetails())
        // ->setIsPreviousCancel($data->getIsPreviousCancel())
        // ->setCancelReason($data->getCancelReason())
        // ->setPurposeOfUse($data->getPurposeOfUse())
        // ->setIsPurposeOfUse($data->getIsPurposeOfUse())
        // ->setExtraPurposeOfUse($data->getExtraPurposeOfUse())
        // ->setIsExtendedFunc($data->getIsExtendedFunc())
        // ->setIsLimitedToOnlyMe($data->getIsLimitedToOnlyMe())
        // ->setPeopleDrivingCar($data->getPeopleDrivingCar())
        // ->setIsUsageInNigeria($data->getIsUsageInNigeria())
        // ->setCountrieOfUse($data->getCountrieOfUse());
        
        $em->persist($motorEntity);
        return $em;
    }

    private function hydrateCropInsurance()
    {
        $em = $this->entityManager;
        $cropInsuranceEntity = $this->entity;
        $data = $this->data;
        
        if ($cropInsuranceEntity == NULL) {
            $cropInsuranceEntity = new CropAgricInsurance();
        }
        
        // $cropInsuranceEntity->setCoverStartDate($data->getCoverStartDate())
        // ->setCropDetails($data->getCropDetails())
        // ->setCoverEndDate($data->getCoverEndDate())
        // ->setCropPerilCoverList($data->getCropPerilCoverList())
        // ->setCropPlantingDate($data->getCropPlantingDate())
        // ->setCropsBiggestThreat($data->getCropsBiggestThreat())
        // ->setCropSeedVariety($data->getCropSeedVariety())
        // ->setCropTypeInsured($data->getCropTypeInsured())
        // ->setEstimatedCostInterestLoan($data->getEstimatedCostInterestLoan())
        // ->setEstimatedCostLandClearing($data->getEstimatedCostLandClearing())
        // ->setEstimatedCostMiscellanous($data->getEstimatedCostMiscellanous())
        // ->setEstimatedCostPlanting($data->getEstimatedCostPlanting())
        // ->setEstimatedCostWeedPestControl($data->getEstimatedCostWeedPestControl())
        // ->setEstimatedHarvetDate($data->getEstimatedHarvetDate());
        if (count($data->getCropPerilCoverList()) > 0) {
            // var_dump("JUUU");
            // var_dump($data->getCropPerilCoverList());
            foreach ($data->getCropPerilCoverList() as $list) {
                $cropInsuranceEntity->addCropPerilCoverList($em->find("Settings\Entity\CropAgricPeril", $list));
            }
        }
        // var_dump($data);
        
        // $cropInsuranceEntity->se
        $em->persist($cropInsuranceEntity);
        return $em;
    }

    private function hydrateLivestock()
    {
        $em = $this->entityManager;
        $liveStockInsuranceEntity = $this->entity;
        $data = $this->data;
        if ($liveStockInsuranceEntity == NULL) {
            $liveStockInsuranceEntity = new LiveStockFarmInsurance();
        }
        
        if (count($data->getMortalityRate()) > 0) {
            $liveStockInsuranceEntity->addMortalityRate($data->getMortalityRate());
        }
        
        if (count($data->getLossHistory()) > 0) {
            $liveStockInsuranceEntity->addLossHistory($data->getLossHistory());
        }
        
        if (count($data->getUseOfAnimals()) > 0) {
            $liveStockInsuranceEntity->addUseOfAnimals($data->getUseOfAnimals());
        }
        
        $em->persist($liveStockInsuranceEntity);
        return $em;
    }

    /**
     * This function return a form entity based on the seeded id
     *
     * @param int $coverId            
     */
    public function getImCoverForm($coverId)
    {
        // $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        // $formManager = $serviceLocator->get("FormElementManager");
        // $viewManager = $serviceLocator->get("ViewHelperManager");
        // $partial = $viewManager->get("partial");
        $formManager = $this->formManager;
        
        $motorForm = $formManager->get("IMServices\Form\MotorInsuranceForm");
        $advancedPaymentBondForm = $formManager->get("IMServices\Form\AdvancedPaymentBondForm");
        $avaiationForm = $formManager->get("IMServices\Form\AviationInsuranceForm");
        $buglaryHouseForm = $formManager->get("IMServices\Form\BuglaryHouseForm");
        $boilerForm = $formManager->get("IMServices\Form\BoilerInsuranceForm");
        $contractAllRiskForm = $formManager->get("IMServices\Form\ContractAllRiskForm");
        $directorLiabilityForm = $formManager->get("IMServices\Form\DirectorsLiabilityForm");
        $oilEnergyForm = $formManager->get("IMServices\Form\OilEnergyForm");
        $employerLiabilityForm = $formManager->get("IMServices\Form\EmployeeLiabilityForm");
        $fidelityGuarateeForm = $formManager->get("IMServices\Form\FidelityGuarateeForm");
        $fireAndSpecialPerilForm = $formManager->get("IMServices\Form\FirAndSpecialPerilForm");
        $gitForm = $formManager->get("IMServices\Form\GitForm");
        $groupLifeForm = $formManager->get("IMServices\Form\GroupLifeForm");
        $travelInsuranceForm = $formManager->get("IMServices\Form\TravelInsuranceForm");
        $machineBreakdownForm = $formManager->get("IMServices\Form\MachineBreakdownForm");
        $marineCargoForm = $formManager->get("IMServices\Form\MarineCargoForm");
        $homeInsuranceForm = $formManager->get("IMServices\Form\HomeInsuranceForm");
        $cashInTransitForm = $formManager->get("IMServices\Form\CashInTransitForm");
        $cashInSafeForm = $formManager->get("IMServices\Form\CashInSafeForm");
        $liveStockFarmInsuranceForm = $formManager->get("IMServices\Form\LiveStockFarmInsuranceForm");
        $cropAgricInsuranceForm = $formManager->get("IMServices\Form\CropAgricInsuranceForm");
        $marineHullForm = $formManager->get("IMServices\Form\MarineHullForm");
        $occupiersLiabilityForm = $formManager->get("IMServices\Form\OccupiersLiabilityForm");
        $personalAccident = $formManager->get("IMServices\Form\PersonalAccidentForm");
        $publicLiabilityForm = $formManager->get("IMServices\Form\PublicLiabilityForm");
        $proffesionalIndemnity = $formManager->get("IMServices\Form\ProffesionalIndemnityForm");
        $agricPropertyForm = $formManager->get("IMServices\Form\AgricProductInsuranceForm");
        $lifePolicyForm = $formManager->get("IMServices\Form\LifePolicyForm");
        $groupPersonalAccidentForm = $formManager->get("IMServices\Form\GroupPersonalAccidentForm");
        $electronicEquipmentForm = $formManager->get("IMServices\Form\ElectronicEquipmentForm");
        $workmenCompensationForm = $formManager->get("IMServices\Form\WorkmenCompensationForm");
        
        switch ($coverId) {
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_COMPREHENSIVE_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_MOTOR:
            case IMService::IM_SPECIFIC_SERVICE_MOTOR_THIRD_PARTY_FIRE_THEFT:
               
                return $motorForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AVIATION_INSURANCE:
              
                return $avaiationForm;
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_PROPERTY_PRODUCE:
                return $agricPropertyForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_BURGLARY_HOUSE_BREAKING:
             
                return $buglaryHouseForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_BOILER:
                return $boilerForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_RISK_THIRD_PARTY_LIABILITY:
            case IMService::IM_SPECIFIC_SERVICE_CONTRACT_ALL_RISK:
                               
                return $contractAllRiskForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_MATERIAL_DAMAGE:
            case IMService::IM_SPECIFIC_SERVICE_ERECTION_THIRD_PARTY:
                
               
                return $contractAllRiskForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_DIRECTORS_LIABILITY:
                // $form = "<h4>CONTRACT ALL RISK</h4><hr>" . $partial("im_service_form_snippet", array(
                // "form" => $contractAllRiskForm,
                // "formFields" => "contract_all_risk_fieldset"
                // ));
                return $directorLiabilityForm;
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_EXTERNAL_DATA:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_INCREASED_COST:
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
                
                
                return $electronicEquipmentForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_EMPLOYERS_LIABILITY:
               
                return $employerLiabilityForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIDELITY_GUARATEE:
                
                
                return $fidelityGuarateeForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_FIRE_PERIL:
                
                return $fireAndSpecialPerilForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GIT_ALL_RISK:
            case IMService::IM_SPECIFIC_SERVICE_GIT_RESTRICTED_COVER:
               
                return $gitForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_GROUP_LIFE_ASSURANCE:
               
                return $groupLifeForm;
                break;
                
                
            case IMService::IM_SPECIFIC_SERVICE_GROUP_OCCUPATIONAL_ACCIDENT:
            case IMService::IM_SPECIFIC_SERVICE_GROUP_PERSONAL_ALL_ACCIDENT:
                
                return $groupPersonalAccidentForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MACHINE_BREAKDOWN:
               
                return $machineBreakdownForm;
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_LIFE_ASSURANCE:
                return $lifePolicyForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_OIL_GAS_ENERGY:
                return $oilEnergyForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PLANT_ALL_RISK:
                
                return $machineBreakdownForm;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ELECTRONIC_EQUIPMENT_MATERIAL_DAMAGE:
               
                return $machineBreakdownForm;
                break;
            
           
            
            /**
             * <p>On the buildings of the Private Dwelling house and all the domestic offices, stables,
             * garages and outbuildings being on the same premises
             * and used in connection therewith including landlord’s fixtures and fittings therein or thereon and the walls, gates and fences around and
             * pertaining thereto.
             * Insurance is against loss or damage caused by Fire, Lightning, Explosion, Bursting or Overflowing of Water Tanks or pipes,
             * Impact by Vehicles or aircraft, loss of Rent, etc. (Full Details available on the Policy)</p>
             */
            case IMService::IM_SPECIFIC_SERVICE_HOME_COMPREHENSIVE:
                
                return $homeInsuranceForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_A:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_B:
            case IMService::IM_SPECIFIC_SERVICE_MARINE_CARGO_ICC_C:
                
                
                return $marineCargoForm;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_TRAVEL_INSURANCE:
               
                return $travelInsuranceForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_ADVANCE_PAYMENT_BOND:
                
                
                return $advancedPaymentBondForm;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_TRANSIT:
                
                return $cashInTransitForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_CASH_IN_SAFE:
                
                return $cashInSafeForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_LIVESTOCK:
               
                return $liveStockFarmInsuranceForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_AGRIC_CROP:
               
                return $cropAgricInsuranceForm;
                
                break;
            case IMService::IM_SPECIFIC_SERVICE_HULL_YACHT:
            case IMService::IM_SPECIFIC_SERVICE_HULL_FISHING_VESSEL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_PORT_RISK:
            case IMService::IM_SPECIFIC_SERVICE_HULL_TIME_HULL:
            case IMService::IM_SPECIFIC_SERVICE_HULL_SPEED_BOAT:
            case IMService::IM_SPECIFIC_SERVICE_HULL_VOYAGE_CLAUSE:
               
                return $marineHullForm;
                
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_OCUPPIERS_LIABILITY:
              
                return $occupiersLiabilityForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PERSONAL_ACCIDENT:
                return $personalAccident;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PUBLIC_LIABILTY:
                return $publicLiabilityForm;
                break;
            
            case IMService::IM_SPECIFIC_SERVICE_PROFESSIONAL_INDEMNTY:
                return $proffesionalIndemnity;
                break;
                
            case IMService::IM_SPECIFIC_SERVICE_WORKMEN_COMPENSATION:
                return $workmenCompensationForm;
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
    
//     private 
    public function portalGenerator(){
        $portalEntity = new Portal();
        $em =  $this->entityManager;
//         $portalEntity->s
    }

    public function setFormManager($formManager)
    {
        $this->formManager = $formManager;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    // Runtime Stters
    
    /**
     *
     * @param object $entity            
     * @return \IMServices\Service\IMService
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     *
     * @param object $data            
     * @return \IMServices\Service\IMService
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setServiceId($id)
    {
        $this->serviceId = $id;
        return $this;
    }
    /**
     * @param field_type $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }

}


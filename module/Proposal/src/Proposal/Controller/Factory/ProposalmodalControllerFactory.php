<?php
namespace Proposal\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Controller\ProposalmodalController;

/**
 *
 * @author otaba
 *        
 */
class ProposalmodalControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new ProposalmodalController();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $renderer = $generalService->getViewRender();
        // $rendererInterface = $serviceLocator->getServicelocator()->get("Zend\View\Renderer\PhpRenderer");
        $formElementManager = $serviceLocator->getServicelocator()->get("FormElementManager");
        $gitVehivleListForm = $formElementManager->get("IMServices\Form\Fieldset\GitVehicleDetailsFieldset");
        $viewRenderer = $serviceLocator->getServiceLocator()->get('ViewRenderer');
        $motorNonStandardAccessoryForm = $formElementManager->get("IMServices\Form\Fieldset\MotorNonStandardAccesoryFieldset");
        $aviationPilotDetailsFeildset = $formElementManager->get("IMServices\Form\Fieldset\AviationinsurancePilotDetailsFieldset");
        $proposalService = $serviceLocator->getServiceLocator()->get('Proposal\Service\ProposalService');
        $motorInsuranceForm = $formElementManager->get("IMServices\Form\MotorInsuranceForm");
        $professionalIndemnityParnerDetails = $formElementManager->get("IMServices\Form\Fieldset\ProfessionalIndemnityParnerDetailsFieldset");
        $boilerCoverDetailsFeildset = $formElementManager->get("IMServices\Form\Fieldset\BoilerCoverDetailsFeildset");
        $buglarySafeDetailsFeildset = $formElementManager->get("IMServices\Form\Fieldset\BuglarySafeDetailsFieldset");
        $contractorAllRiskValueListFieldset = $formElementManager->get("IMServices\Form\Fieldset\ContractAllRiskValueListFieldset");
        $agricProductListFieldset = $formElementManager->get("IMServices\Form\Fieldset\AgricPropertyInsuranceListFieldset");
        $groupPersonalFixedDetails = $formElementManager->get("IMServices\Form\Fieldset\GroupPersonalFixedDetailsFieldset");
        $groupPersonalWagesDetails = $formElementManager->get("IMServices\Form\Fieldset\GroupPersonalWagesDetailsFieldset");
        $cropStaffListFieldset = $formElementManager->get("IMServices\Form\Fieldset\CropInsuranceStafffDetailsFieldset");
        $cropAgricListFieldset = $formElementManager->get("IMServices\Form\Fieldset\CropAgricCropDetailsFieldset");
        $livestockInsuredListFieldset = $formElementManager->get("IMServices\Form\Fieldset\LivestockInsuredListFieldset");
        $groupLifeStaffDetailsFieldset = $formElementManager->get("IMServices\Form\Fieldset\GroupLifeEmployeeListFieldset");
        $workmenDecreeListFieldset = $formElementManager->get("IMServices\Form\Fieldset\WorkmenDecreeListFieldset");
        $employeeLiabilityDetailsFieldset = $formElementManager->get("IMServices\Form\Fieldset\EmployeeLiabilityDEtailsFieldset");
        $fidelityGaurateeEmployeeListFieldset = $formElementManager->get("IMServices\Form\Fieldset\FidelityGaurateeEmployeeListFieldset");
        $homeHouseholdGoodFieldset = $formElementManager->get("IMServices\Form\Fieldset\HomeHouseholdGoodsFieldset");
        $homeHouseValuableFieldset = $formElementManager->get("IMServices\Form\Fieldset\HomeHpuseValuablesFieldset");
        $occupiersLiabilityStaffFieldset = $formElementManager->get("IMServices\Form\Fieldset\OccupierLiabilityStaffFieldset");
        $occupiersLiabilityFamilyFieldset = $formElementManager->get("IMServices\Form\Fieldset\OccupiersLiabilityFamiliyFieldset");
        $publicLiabilityEmployeeFieldset = $formElementManager->get("IMServices\Form\Fieldset\PublicLiabityEmployeeDetailsFieldset");
        $workmenContractorListFieldset = $formElementManager->get("IMServices\Form\Fieldset\WorkmenContractorsListFieldset");
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        
        $ctr->setEntityManager($em)
            ->setGitVehicleListForm($gitVehivleListForm)
            ->setRenderer($renderer)
            ->setViewRenderer($viewRenderer)
            ->setMotorNonStandardForm($motorNonStandardAccessoryForm)
            ->setProfessionalIndemnityForm($professionalIndemnityParnerDetails)
            ->setMotorInsuranceForm($motorInsuranceForm)
            ->setAviationPiltoDetailsFeildet($aviationPilotDetailsFeildset)
            ->setBoilerCoverDetailsFieldset($boilerCoverDetailsFeildset)
            ->setBuglarySafeDetailsForm($buglarySafeDetailsFeildset)
            ->setContractAllRiskValueListFieldset($contractorAllRiskValueListFieldset)
            ->setProposalService($proposalService)
            ->setSelectObjectForm($selectObjectForm)
            ->setGeneralService($generalService)
            ->setObjectForm($objectForm)
            ->setObjectService($objectService)
            ->setAgricproductListFieldset($agricProductListFieldset)
            ->setGroupPersonalFixedFieldset($groupPersonalFixedDetails)
            ->setGroupPersonalWagesFieldset($groupPersonalWagesDetails)
            ->setCropStaffListFieldset($cropStaffListFieldset)
            ->setCropAgricListFieldset($cropAgricListFieldset)
            ->setLivestockInsuredListFieldset($livestockInsuredListFieldset)
            ->setGroupLifeStaffDetailsFieldset($groupLifeStaffDetailsFieldset)
            ->setWorkmenDecreeListFieldset($workmenDecreeListFieldset)
            ->setEmployeeLiabilityDetailsFieldset($employeeLiabilityDetailsFieldset)
            ->setFidelityGaurateeEmployeeListFieldset($fidelityGaurateeEmployeeListFieldset)
            ->setHomeHouseholdGoodsFieldset($homeHouseholdGoodFieldset)
            ->setHomeHouseValueableFiedset($homeHouseValuableFieldset)
            ->setOccupiersLiabilityStaffFieldset($occupiersLiabilityStaffFieldset)
            ->setPublicLiabilityEmployeeFieldset($publicLiabilityEmployeeFieldset)
            ->setoccupiersLiabilityFamilyFieldset($occupiersLiabilityFamilyFieldset)
            ->setWorkmencontractorlistFieldset($workmenContractorListFieldset);
        return $ctr;
    }
}


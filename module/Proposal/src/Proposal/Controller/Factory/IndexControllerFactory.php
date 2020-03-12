<?php
namespace Proposal\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\Controller\IndexController;
use Proposal\Entity\Proposal;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
        $proposalEntity = new Proposal();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $proposalService = $serviceLocator->getServiceLocator()->get('Proposal\Service\ProposalService');
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $centralBrokerId = $generalService->getCentralBroker();
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $currencyService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\CurrencyService");
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $premiumService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\PremiumService");
        $imService = $serviceLocator->getServiceLocator()->get("IMServices\Service\IMService");
        $policyService = $serviceLocator->getServiceLocator()->get('Policy\Service\PolicyService');
        
        $mailService = $generalService->getMailService();
        $proposalForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Proposal\Form\ProposalForm');
        
        $uploadForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("GeneralServicer\Form\UploadForm");
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $manualPremiumForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\ManualPremiumForm");
        
        $microPaymentForm = $serviceLocator->getServicelocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\MicroPaymentForm");
        
        $manualPaymentForm = $serviceLocator->getServicelocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\ManualPaymentForm");
        
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        
        $exportToInsurerForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\ExportToInsurerForm");
        
        // IM FORM service
        $formElementManager = $serviceLocator->getServicelocator()->get("FormElementManager");
        $motorForm = $formElementManager->get("IMServices\Form\MotorInsuranceForm");
        $advancedBondForm = $formElementManager->get("IMServices\Form\AdvancedPaymentBondForm");
        $aviationForm = $formElementManager->get("IMServices\Form\AviationInsuranceForm");
        $buglaryForm = $formElementManager->get("IMServices\Form\BuglaryHouseForm");
        $contractAllRiskForm = $formElementManager->get("IMServices\Form\ContractAllRiskForm");
        $employeeLiabilityForm = $formElementManager->get("IMServices\Form\EmployeeLiabilityForm");
        $fidelityGuarateeForm = $formElementManager->get("IMServices\Form\FidelityGuarateeForm");
        $fireSpecialPerilForm = $formElementManager->get("IMServices\Form\FirAndSpecialPerilForm");
        $gitForm = $formElementManager->get("IMServices\Form\GitForm");
        $groupLifeForm = $formElementManager->get("IMServices\Form\GroupLifeForm");
        $travelInsuranceForm = $formElementManager->get("IMServices\Form\TravelInsuranceForm");
        $machineBreakDownForm = $formElementManager->get("IMServices\Form\MachineBreakdownForm");
        $marineCargoForm = $formElementManager->get("IMServices\Form\MarineCargoForm");
        $homeInsuranceForm = $formElementManager->get("IMServices\Form\HomeInsuranceForm");
        $cashInTransitForm = $formElementManager->get("IMServices\Form\CashInTransitForm");
        $cashInSafeForm = $formElementManager->get("IMServices\Form\CashInSafeForm");
        $liveStockInsuranceForm = $formElementManager->get("IMServices\Form\LiveStockFarmInsuranceForm");
        $cropInsuranceForm = $formElementManager->get("IMServices\Form\CropAgricInsuranceForm");
        $marineHullForm = $formElementManager->get("IMServices\Form\MarineHullForm");
        $occupierslIabilityForm = $formElementManager->get("IMServices\Form\OccupiersLiabilityForm");
        $motorForm = $formElementManager->get("IMServices\Form\MotorInsuranceForm");
        $buglaryForm = $formElementManager->get("IMServices\Form\BuglaryHouseForm");
        $boilerInsuranceForm = $formElementManager->get("IMServices\Form\BoilerInsuranceForm");
        $oilEnergyForm = $formElementManager->get("IMServices\Form\OilEnergyForm");
        $publicLiabilityForm = $formElementManager->get("IMServices\Form\PublicLiabilityForm");
        $proffesionalIndemnityForm = $formElementManager->get("IMServices\Form\ProffesionalIndemnityForm");
        $directorsLiabilityForm = $formElementManager->get("IMServices\Form\DirectorsLiabilityForm");
        $agricProductForm = $formElementManager->get("IMServices\Form\AgricProductInsuranceForm");
        $lifePolicyForm = $formElementManager->get("IMServices\Form\LifePolicyForm");
        $groupPersonalAccidentForm = $formElementManager->get("IMServices\Form\GroupPersonalAccidentForm");
        $electronicEquipmentForm = $formElementManager->get("IMServices\Form\ElectronicEquipmentForm");
        //
        
        $workmenCompensationForm = $formElementManager->get("IMServices\Form\WorkmenCompensationForm");
        
        $renderer = $generalService->getViewRender();
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $ctr->setEntityManager($em)
            ->setProposalForm($proposalForm)
            ->setProposalService($proposalService)
            ->setGeneralService($generalService)
            ->setProposalEntity($proposalEntity)
            ->setViewRenderer($renderer)
            ->setCentralBrokerId($centralBrokerId)
            ->setObjectForm($objectForm)
            ->setObjectService($objectService)
            ->setCentralBrokerId($centralBrokerId)
            ->setSelectObjectForm($selectObjectForm)
            ->setMessageForm($messageForm)
            ->setMessageService($messageService)
            ->setCoverNoteService($coverNoteService)
            ->setManualPremiumForm($manualPremiumForm)
            ->setCurrencyService($currencyService)
            ->setDropZoneUploadForm($dropZoneUploadForm)
            ->setBlobService($blobService)
            ->setUploadForm($uploadForm)
            ->setMicroPaymentForm($microPaymentForm)
            ->setInvoiceService($invoiceService)
            ->setPremiumService($premiumService)
            ->setPolicySevice($policyService)
            ->setMailService($mailService)
            ->setManualPaymentForm($manualPaymentForm)
            ->setExportToInsurerForm($exportToInsurerForm);
        
        // $gitVehivleListForm = $formElementManager->get("IMServices\Form\GitVehicleListForm");
        //
        //
        // Begin IMSericvce Form;
        $ctr->setMotorForm($motorForm)
            ->setImService($imService)
            ->setHouseBuglaryForm($buglaryForm)
            ->setAviationForm($aviationForm)
            ->setGitForm($gitForm)
            ->setEmployeeLiabilityForm($employeeLiabilityForm)
            ->setOccupiersLiabilityForm($occupierslIabilityForm)
            ->setMarineCargoForm($marineCargoForm)
            ->setMarineHullForm($marineHullForm)
            ->setCashInSafeForm($cashInSafeForm)
            ->setCashInTransitForm($cashInTransitForm)
            ->setCropAgricInsuranceForm($cropInsuranceForm)
            ->setLivestockAgricInsuranceForm($liveStockInsuranceForm)
            ->setFireSpecialPerilForm($fireSpecialPerilForm)
            ->setFidelityGuarateeForm($fidelityGuarateeForm)
            ->setGroupLifeForm($groupLifeForm)
            ->setHomeInsuranceForm($homeInsuranceForm)
            ->setMachineBreakDownForm($machineBreakDownForm)
            ->setTravelInsuranceForm($travelInsuranceForm)
            ->setContractAllRiskForm($contractAllRiskForm)
            ->setAdvanceBondForm($advancedBondForm)
            ->setBoilerInsuranceForm($boilerInsuranceForm)
            ->setBuglaryForm($buglaryForm)
            ->setOilEnergyForm($oilEnergyForm)
            ->setPublicLiabilityForm($publicLiabilityForm)
            ->setProffesionalIndemnityForm($proffesionalIndemnityForm)
            ->setDirectorsLiabilityForm($directorsLiabilityForm)
            ->setAgricPropertyForm($agricProductForm)
            ->setLifeAssuranceForm($lifePolicyForm)
            ->setGroupPersonalAccidentForm($groupPersonalAccidentForm)
            ->setElectronicEquipmentForm($electronicEquipmentForm)
            ->setWorkmenCompensationForm($workmenCompensationForm);
        
        return $ctr;
    }
}


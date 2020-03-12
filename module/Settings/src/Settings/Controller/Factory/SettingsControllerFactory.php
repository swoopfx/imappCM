<?php
namespace Settings\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Settings\Controller\SettingsController;
use Users\Entity\BrokerBankAccount;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author swoopfx
 *        
 */
class SettingsControllerFactory implements FactoryInterface
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
        $ctr = new SettingsController();
        $brokerBankAccountEntity = new BrokerBankAccount();
       /**
        * 
        * @var GeneralService $generalService
        */
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $brokerGeneralService = $serviceLocator->getServiceLocator()->get("Users\Service\BrokerGeneralService");
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $payStackPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PayStackPaymentService");
        $centralBrokerId = $generalService->getCentralBroker();
        $renderer = $generalService->getViewRender();
        $brokerChildId = $generalService->getChildBrokerId();
        
        $accountForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Settings\Form\BrokerBankAccountForm");
        
        $accountNameForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Settings\Form\AccountNameRequestForm");
        
        $ceoForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Users\Form\BrokerCeoForm");
        
        $brokerChildForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Users\Form\BrokerChildForm");
        
            $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
            
            
        
        $em = $generalService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setBankAccountform($accountForm)
            ->setBrokerId($generalService->getCentralBroker())
            ->setBankAccountEntity($brokerBankAccountEntity)
            ->setBrokerGeneralService($brokerGeneralService)
            ->setPaymentService($paymentService)
            ->setAccountNameForm($accountNameForm)
            ->setCeoForm($ceoForm)->setGeneralService($generalService)
            ->setBrokerChildId($brokerChildId)
            ->setBrokerChildForm($brokerChildForm)
            ->setCentralBroker($centralBrokerId)
            ->setPayStackPaymentService($payStackPaymentService)
            ->setRenderer($renderer)
            ->setBlobService($blobService)->setDropZoneForm($dropZoneUploadForm);
           
        return $ctr;
    }
}


<?php
namespace Offer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Controller\IndexController;
use Offer\Entity\Offer;
use IMServices\Entity\MotorOfferData;

// use Object\Form\Fieldset\ObjectFieldset;
// use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
        $offerEntity = new Offer();
        $motorEntity = new MotorOfferData();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $currencyService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\CurrencyService");
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        
        // $form = $serviceLocator->getServiceLocator ()->get ( 'new_offer_form' );
        // $ctr->setOfferForm($form);
        $em = $generalService->getEntityManager();
        $offerService = $serviceLocator->getServiceLocator()->get('Offer\Service\OfferService');
        $offerIndexService = $serviceLocator->getServiceLocator()->get('offer_index_controller_service');
        $usersService = $serviceLocator->getServiceLocator()->get('users_service_main'); // this is the service for Users Namespace
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $mailService = $generalService->getMailService();
        $centralBrokerId = $generalService->getCentralBroker();
        $offerSession = $offerService->getOfferSession();
        
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $offerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Offer\Form\OfferForm');
        
        $microPaymentForm = $serviceLocator->getServicelocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\MicroPaymentForm");
        
        $recommendForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Offer\Form\ReccomendInsurerForm');
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $offerInfoForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Offer\Form\OfferInfoForm');
        $coverNoteForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\CoverNoteForm');
        
        $offerPremiumForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Offer\Form\OfferPremiumForm');
        // var_dump($offerPremiumForm);
        $manualPremiumForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\ManualPremiumForm");
        // var_dump($manualPremiumForm);
        
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        
        $ctr->setEntityManager($em)
            ->setOptions($op)
            ->setOfferEntity($offerEntity)
            ->setOfferService($offerService)
            ->setObjectForm($objectForm)
            ->setGeneralService($generalService)
            ->setObjectService($objectService)
            ->setOfferForm($offerForm)
            ->setInvoiceService($invoiceService)
            ->setUserService($usersService)
            ->setMailService($mailService)
            ->setOfferSession($offerSession)
            ->setCentralBrokerId($centralBrokerId)
            ->setCoverNoteForm($coverNoteForm)
            ->setCoverNoteService($coverNoteService)
            ->setMessageForm($messageForm)
            ->setRenderer($renderer)
            ->setMessageService($messageService)
            ->setSelectObjectForm($selectObjectForm)
            ->setRecommnedForm($recommendForm)
            ->setMicroPaymentForm($microPaymentForm)
            ->setManualPremiumForm($manualPremiumForm)
            ->setCurrencyService($currencyService)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setBlobService($blobService);
        return $ctr;
    }
}

?>
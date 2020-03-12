<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\ProposalController;

/**
 *
 * @author otaba
 *        
 */
class ProposalControllerFactory implements FactoryInterface
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
        $ctr = new ProposalController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $invoiceService = $serviceLocator->getServiceLocator()->get('Transactions\Service\InvoiceService');
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        $em = $clientGeneralService->getEntityManager();
        $generalSession = $clientGeneralService->getGeneralService()->getGeneralSession();
        $ctr->setEntityManager($em)
            ->setClientGeneralService($clientGeneralService)
            ->setCustomerBoardService($boardService)
            ->setInvoiceService($invoiceService)
            ->setMessageForm($messageForm)
            ->setMessageService($messageService)
            ->setSelectObjectForm($selectObjectForm)
            ->setObjectForm($objectForm)
            ->setObjectService($objectService)
            ->setGeneralSession($generalSession)
            ->setRenderer($renderer)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setBlobService($blobService);
        return $ctr;
    }
}


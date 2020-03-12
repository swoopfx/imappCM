<?php
namespace Packages\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Controller\AcquirePackagesController;

/**
 *
 * @author otaba
 *        
 */
class AcquirePackagesControllerFactory implements FactoryInterface
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
        $ctr = new AcquirePackagesController();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $packageService = $serviceLocator->getServiceLocator()->get("Packages\Service\PackageService");
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $acquiredPackageService = $serviceLocator->getServiceLocator()->get("Packages\Service\AcquirePackagesService");
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $mailService = $generalService->getMailService();
        $centralBrokerId = $generalService->getCentralBroker();
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $em = $generalService->getEntityManager();
        $acquiredSession = $acquiredPackageService->getAcquiredPackageSession();
        $ctr->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setPackageService($packageService)
            ->setAcquiredSession($acquiredSession)
            ->setNewObjectform($objectForm)
            ->setSelectObjectForm($selectObjectForm)
            ->setObjectService($objectService)
            ->setInvoiceService($invoiceService)
            ->setMessageForm($messageForm)
            ->setMessageService($messageService)
            ->setCoverNoteService($coverNoteService)->setCentralBrokerId($centralBrokerId);
        return $ctr;
    }
}


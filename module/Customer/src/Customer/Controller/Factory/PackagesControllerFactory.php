<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Customer\Controller\PackagesController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Entity\CustomerPackage;

class PackagesControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PackagesController();
        $customerPackageEntity = new CustomerPackage();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $customerBoardService = $serviceLocator->getServiceLocator()->get("Customer\Service\CustomerBoardService");
        $customerPackageService = $serviceLocator->getServiceLocator()->get("Customer\Service\CustomerPackageService");
        $acquirePackageService = $serviceLocator->getServiceLocator()->get("Packages\Service\AcquirePackagesService");
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $invoiceService = $serviceLocator->getServiceLocator()->get('Transactions\Service\InvoiceService');
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        $objectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\ObjectForm");
        $selectObjectForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Object\Form\SelectObjectForm");
        
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $em = $clientGeneralService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setCustomerBoardService($customerBoardService)
            ->setCustomerPackageService($customerPackageService)
            ->setCustomerPackageEntity($customerPackageEntity)
            ->setClientGeneralService($clientGeneralService)
            ->setAcquiredPackageService($acquirePackageService)
            ->setObjectForm($objectForm)
            ->setObjectService($objectService)
            ->setInvoiceService($invoiceService)
            ->setSelectObjetForm($selectObjectForm)
            ->setMessageForm($messageForm)
            ->setMessageService($messageService);
        return $ctr;
    }
}
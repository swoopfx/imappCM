<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Customer\Service\CustomerPackageService;
use Object\Entity\Object;

class CustomerPackageServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xser = new CustomerPackageService();
        $customerPackageSession = new Container("packageSession");
        $objectEntity = new Object();
        $customerPackageObjectForm = $serviceLocator->get('FormElementManager')->get("Customer\Form\CustomerPackageObjectForm");
        $clientGeneralService = $serviceLocator->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $xser->setCustomerPackageSession($customerPackageSession)
            ->setEntityManager($em)
            ->setClientGeneralService($clientGeneralService)
            ->setEntityManager($em)
            ->setObjectForm($customerPackageObjectForm)
            ->setObjectEntity($objectEntity);
        
        return $xser;
    }
}
<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Customer\Service\CustomerBoardService;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomerBoardServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new CustomerBoardService();
        
        $clientGeneralService = $serviceLocator->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        
        $xserv->setEntityManager($em)
            ->setClientGeneralService($clientGeneralService)
            ->setBrokerId($clientGeneralService->getBrokerId())->setCustomerId()
            ->setAuth($clientGeneralService->getClientAuth());
           
        return $xserv;
    }
}
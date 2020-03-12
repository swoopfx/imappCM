<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\InvoiceController;

class InvoiceControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new InvoiceController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $em = $clientGeneralService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setCustomerBoardService($boardService)
            ->setClientGeneralService($clientGeneralService)->setRenderer($renderer);
        return $ctr;
    }
}
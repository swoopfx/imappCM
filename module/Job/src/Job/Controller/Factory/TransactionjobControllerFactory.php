<?php
namespace Job\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Controller\TransactionjobController;

class TransactionjobControllerFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new TransactionjobController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();

        $ctr->setClientGeneralService($clientGeneralService)
            ->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setSmsService($smsService);
        return $ctr;
    }
}


<?php
namespace Job\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Controller\ObjectjobController;

/**
 *
 * @author otaba
 *        
 */
class ObjectjobControllerFactory implements FactoryInterface
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
        $ctr = new ObjectjobController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setClientGeneralService($clientGeneralService);
        return $ctr;
    }
}


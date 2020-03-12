<?php
namespace Job\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Controller\PolicyjobController;

/**
 *
 * @author otaba
 *        
 */
class PolicyjobControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PolicyjobController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();
        
        $ctr->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setSmsService($smsService)
            ->setClientGeneralService($clientGeneralService);
        return $ctr;
    }
}


<?php
namespace Job\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Controller\JobController;

/**
 *
 * @author otaba
 *        
 */
class JobControllerFactory implements FactoryInterface
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
        $ctr = new JobController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();
        $ctr->setClientGeneralService($clientGeneralService)
            ->setEntityManager($em)
            ->setGeneralService($generalService);
        return $ctr;
    }
}


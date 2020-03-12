<?php
namespace Job\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Controller\PaymentjobController;

/**
 *
 * @author otaba
 *        
 */
class PaymentjobControllerFactory implements FactoryInterface
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
        $job = new PaymentjobController();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $ravePaymentService = $serviceLocator->get("Transactions\Service\RavePaymentService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();
        $job->setEntityManager($em)
            ->setSmsService($smsService)
            ->setRavePaymentService($ravePaymentService);
        return $job;
    }
}


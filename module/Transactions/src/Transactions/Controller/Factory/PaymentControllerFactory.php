<?php
namespace Transactions\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Controller\PaymentController;

/**
 *
 * @author otaba
 *        
 */
class PaymentControllerFactory implements FactoryInterface
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
        $ctr = new PaymentController();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");
        $em = $generalService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setPaymentService($paymentService)
            ->setGeneralService($generalService);
        return $ctr;
    }
}


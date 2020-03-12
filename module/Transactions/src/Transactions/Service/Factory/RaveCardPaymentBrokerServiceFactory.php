<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\RaveCardPaymentBrokerService;
use GeneralServicer\Service\GeneralService;
use Zend\Session\Container;

class RaveCardPaymentBrokerServiceFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new RaveCardPaymentBrokerService();
        /**
         *
         * @var GeneralService $generalService
         */
        $ravePaymentSession = new Container("rave_payment_broker_session");
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        $xserv->setEntityManager($generalService->getEntityManager())
            ->setGeneralService($generalService)
            ->setTransactionService($transactionService)
            ->setRavePaymentSession($ravePaymentSession);

        return $xserv;
    }
}


<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\RavePaymentService;
use Transactions\Entity\Transaction;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class RavePaymentServiceFactory implements FactoryInterface
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
        $xserv = new RavePaymentService();
        $transactionEntity = new Transaction();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $ravePaymentSession = new Container("rave_payment_session");
        $clientGeneralService = $serviceLocator->get('Customer\Service\ClientGeneralService');
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $xserv->setEntityManager($em)
            ->setRavePaymentSession($ravePaymentSession)
            ->setClientGeneralService($clientGeneralService)
            ->setTransactionService($transactionService);
        return $xserv;
    }
}


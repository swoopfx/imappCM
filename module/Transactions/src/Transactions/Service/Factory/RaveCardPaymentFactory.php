<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\RaveCardPaymentService;
use Transactions\Entity\Transaction;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class RaveCardPaymentFactory implements FactoryInterface
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
        $xserv = new RaveCardPaymentService();
        $transactionEntity = new Transaction();
        $ravePaymentSession = new Container("rave_payment_session");
        $clientGeneralService = $serviceLocator->get('Customer\Service\ClientGeneralService');
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        $mailService = $serviceLocator->get('acmailer.mailservice.default');
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $xserv->setEntityManager($em)
            ->setRavePaymentSession($ravePaymentSession)
            ->setClientGeneralService($clientGeneralService)
            ->setMailService($mailService)
            ->setGeneralService($generalService)
            ->setTransactionService($transactionService);
        return $xserv;
    }
}


<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\PayStackPaymentService;

/**
 *
 * @author otaba
 *        
 */
class PaystackPaymentServiceFactory implements FactoryInterface
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
        $xserv = new PayStackPaymentService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $invoiceService = $serviceLocator->get('Transactions\Service\InvoiceService');
        $transactionService = $serviceLocator->get("Transactions\Service\TransactionService");
        $myCurrencyFormat = $serviceLocator->get("ViewHelperManager")->get("myCurrencyFormat");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $userId = $generalService->getUserId();
        $xserv->setEntityManager($em)
            ->setCentralBrokerId($centralBrokerId)
            ->setInvoiceService($invoiceService)
            ->setMyCurrencyFormat($myCurrencyFormat)
            ->setUserId($userId);
        return $xserv;
    }
}


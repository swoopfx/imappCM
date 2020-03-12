<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\InvoiceService;
use Transactions\Entity\Invoice;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class InvoiceServiceFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $invoice = new InvoiceService();
        $microPaymentSession = new Container("micro_payment_session");
        $invoiceEntity = new Invoice();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
        $transactionservice = $serviceLocator->get("Transactions\Service\TransactionService");
        
        $centralBrokerId = $generalService->getCentralBroker();
        $em = $generalService->getEntityManager();
        $auth = $generalService->getAuth();
        $userId = $generalService->getUserId();
        
        $invoice->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setInvoiceEntity($invoiceEntity)
            ->setUserId($userId)
            ->setTransactionService($transactionservice)
            ->setCentralBrokerId($centralBrokerId)
            ->setMicroPaymentSession($microPaymentSession);
        
        return $invoice;
    }
}

?>
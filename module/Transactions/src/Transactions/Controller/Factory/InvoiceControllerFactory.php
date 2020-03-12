<?php
namespace Transactions\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Controller\InvoiceController;

/**
 *
 * @author otaba
 *        
 */
class InvoiceControllerFactory implements FactoryInterface
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
        $ctr = new InvoiceController();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $offerService = $serviceLocator->getServiceLocator()->get("Offer\Service\OfferService");
        $em = $generalService->getEntityManager();
        $brokerId = $generalService->getCentralBroker();
        $mailService = $generalService->getMailService();
        $renderer = $generalService->getViewRender();
//         $centralBrokerId = $generalService->getCentralBroker();
        
//         var_dump($brokerId);
        $processForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\TransactionInvoiceProcessManualPaymentForm');
        
        $ctr->setEntityManager($em)
            ->setInvoiceService($invoiceService)
            ->setBrokerId($brokerId)
            ->setMailSerive($mailService)
            ->setProcessForm($processForm)
            ->setOfferService($offerService)
            ->setGeneralService($generalService)
            ->setRenderer($renderer)
            ->setCentralBrokerId($brokerId);
        return $ctr;
    }
}


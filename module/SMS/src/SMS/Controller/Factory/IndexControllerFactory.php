<?php
namespace SMS\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SMS\Controller\IndexController;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
        $buySmsForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('SMS\Form\BuySmsForm');
        
        $otpForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\OTPForm');
        
        $paymentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Transactions\Form\UserCardPaymentForm");
        
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $smsService = $serviceLocator->getServiceLocator()->get('SMS\Service\SMSService');
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $payStackpaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PayStackPaymentService");
        $transactionService = $serviceLocator->getServiceLocator()->get("Transactions\Service\TransactionService");
        $moneywaveService = $serviceLocator->getServiceLocator()->get("Transactions\Service\MoneyWavePaymentService");
        $raveCardPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RaveCardPaymentBrokerService");
        $em = $generalService->getEntityManager();
        
        $cardPinForm = $serviceLocator->getServiceLocator()
        ->get('FormElementManager')
        ->get("Transactions\Form\CardPinForm");
        
        $centralBrokerId = $generalService->getCentralBroker();
        $ctr->setGeneralService($generalService)
            ->setSmsService($smsService)
            ->setBuySMSForm($buySmsForm)
            ->setEntityManager($em)
            ->setPaystackPaymentService($payStackpaymentService)
            ->setCentralBrokerId($centralBrokerId)
            ->setInvoiceService($invoiceService)
            ->setTransactionService($transactionService)
            ->setMoneyWaveService($moneywaveService)
            ->setRenderer($renderer)
            ->setOtpForm($otpForm)
            ->setCardPinForm($cardPinForm)
            ->setRaveCardPaymentService($raveCardPaymentService)
            ->setCardPaymentForm($paymentForm);
        return $ctr;
    }
}


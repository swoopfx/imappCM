<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\PaymentController;

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
        $ctr = new PaymentController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");
        $payStackpaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PayStackPaymentService");
        $ravePaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RavePaymentService");
        $raveCardPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RaveCardPaymentService");
        $raveBankPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RaveBankPaymentService");
        $claimService = $serviceLocator->getServiceLocator()->get("Claims\Service\ClaimsService");
        $mailService = $clientGeneralService->getGeneralService()->getMailService();
        $transactionService = $serviceLocator->getServiceLocator()->get("Transactions\Service\TransactionService");
        $moneyWaveService = $serviceLocator->getServiceLocator()->get("Transactions\Service\MoneyWavePaymentService");
        
        $paymentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Transactions\Form\UserCardPaymentForm");
        
        $cardPinForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Transactions\Form\CardPinForm");
        
        $otpForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\OTPForm');
        $pinCodeForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Customer\Form\CustomerPinCodeForm");
        
        $bankPaymentForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\TransactionBankPaymentForm");
        
        $cardBillingForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\TransactionCardBillingAddressForm");
        
        $em = $clientGeneralService->getGeneralService()->getEntityManager();
        $ctr->setEntityManager($em)
        ->setRaveCardPaymentService($raveCardPaymentService)
            ->setClientSession($clientGeneralService->getClientSession())
            ->setClientGeneralService($clientGeneralService)
            ->setCustomerBoardService($boardService)
            ->setCardPaymentForm($paymentForm)
            ->setPaymentService($paymentService)
//            ->setGeneralService($g)
            ->setOtpForm($otpForm)
            ->setPinCodeForm($pinCodeForm)
            ->setTransactionService($transactionService)
            ->setCardPinForm($cardPinForm)
            ->setRendrer($renderer)
           ->setRaveBankPaymentService($raveBankPaymentService)
            ->setBankPaymentForm($bankPaymentForm)
            ->setCardBillingForm($cardBillingForm);
        return $ctr;
    }
}


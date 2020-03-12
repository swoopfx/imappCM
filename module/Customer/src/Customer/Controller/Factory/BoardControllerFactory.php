<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\BoardController;

/**
 *
 * @author swoopfx
 *        
 */
class BoardControllerFactory implements FactoryInterface
{

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
        $ctr = new BoardController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");
        $payStackpaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PayStackPaymentService");
        $ravePaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RavePaymentService");
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
        
        $customerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\CustomerForm');
        $claimPreForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\CustomerClaimsPreForm');
        
        $manualProcessForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Transactions\Form\TransactionManualProcessForm");
        
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
            ->setClientSession($clientGeneralService->getClientSession())
            ->setClientGeneralService($clientGeneralService)
            ->setCustomerBoardService($boardService)
            ->setPaymentForm($paymentForm)
            ->setEditProfileForm($customerForm)
            ->setPaymentService($paymentService)
            ->setClaimsPreForm($claimPreForm)
            ->setClaimsService($claimService)
            ->setManualProcessForm($manualProcessForm)
            ->setMailService($mailService)
            ->setOtpForm($otpForm)
            ->setPinCodeForm($pinCodeForm)
            ->setPaystackPaymentService($payStackpaymentService)
            ->setTransactionService($transactionService)
            ->setCardPinForm($cardPinForm)
            ->setRendrer($renderer)
            ->setRavePaymentService($ravePaymentService)
            ->setMoneyWaveService($moneyWaveService)
            ->setBankPaymentForm($bankPaymentForm)
            ->setCardBillingForm($cardBillingForm);
        return $ctr;
    }
}


<?php
namespace Settings\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Settings\Controller\AccountController;

/**
 *
 * @author swoopfx
 *        
 */
class AccountControllerFactory implements FactoryInterface
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
        $ctr = new AccountController();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $invoiceSevice = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        // $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        $centralBrokerId = $generalService->getCentralBroker();
        $mailService = $generalService->getMailService();
        
        
        $renewForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Settings\Form\RenewAccountForm');
        
        $brokerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\BrokerSetUpDataForm');
        
        $otpForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\OTPForm');
        
        $ctr->setEntityManager($em)
            ->setgeneralService($generalService)
            ->setRenewalForm($renewForm)
            ->setInvoiceService($invoiceSevice)
            ->setOptForm($otpForm)
            ->setMailService($mailService)
            ->setCentralBrokerId($centralBrokerId)
            ->setPaymentService($paymentService)
            ->setSmsService($smsService)
            ->setBrokerForm($brokerForm);
        return $ctr;
    }
}


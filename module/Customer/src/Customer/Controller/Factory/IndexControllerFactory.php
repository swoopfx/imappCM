<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\IndexController;
use Customer\Entity\Customer;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
        $customerEntity = new Customer();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $invoiceService = $serviceLocator->getServiceLocator()->get("Transactions\Service\InvoiceService");
        $em = $generalService->getEntityManager();
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        $claimsService = $serviceLocator->getServiceLocator()->get("Claims\Service\ClaimsService");
        $customerService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerService');
        $objectService = $serviceLocator->getServiceLocator()->get('Object\Service\ObjectService');
        $policyService = $serviceLocator->getServiceLocator()->get("Policy\Service\PolicyService");
        $brokerCustomerSession = $customerService->getBrokerCustomerSession();
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $messageService = $serviceLocator->getServiceLocator()->get("Messages\Service\MessageService");
        
        $pincodeForm = $serviceLocator->getServiceLocator()
        ->get('FormElementManager')
        ->get('Customer\Form\CustomerPinCodeForm');
        
        $uploadPolicyForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('BrokersTool\Form\AssignBrokerForm');
        
        $policyFloatForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicyFloatForm");
        
//             var_dump($policyFloatForm);
        
        // $policyFloatForm = $serviceLocator->getServiceLocator()
        // ->get("FormElementManager")
        // ->get("Policy\Form\PolicyFLoatUploadForm");
        
        $assignBrokerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('BrokersTool\Form\AssignBrokerForm');
        $objectPreForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Object\Form\ObjectForm');
        
        $customerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\CustomerForm');
        
        $customerPinForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get(' Customer\Form\CustomerPinCodeForm');
        $otpForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\OTPForm');
        
        $messageForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Messages\Form\MessageForm");
        
        $policyGenerationForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicyForm");
        
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        
        $serviceLocator = $serviceLocator->getServiceLocator();
        
        $ctr->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setCustomerForm($customerForm)
            ->setCustomerService($customerService)
            ->setCustomerEntity($customerEntity)
            ->setCustomerService($customerService)
            ->setObjectPreForm($objectPreForm)
            ->setBrokerCustomerSession($brokerCustomerSession)
            ->setObjectService($objectService)
            ->setClaimsService($claimsService)
            ->setInvoiceService($invoiceService)
            ->setAssignBrokerForm($assignBrokerForm)
            ->setCentralBrokerId($generalService->getCentralBroker())
            ->setCustomerPinForm($customerPinForm)
            ->setSmsService($smsService)
            ->setOtpForm($otpForm)
            ->setPolicyService($policyService)
            ->setMessageForm($messageForm)
            ->setRenderer($renderer)
            ->setMessageService($messageService)
            ->setPolicyUploadForm($policyGenerationForm)
            ->setPolicyFloatForm($policyFloatForm)
            ->setCoverNoteService($coverNoteService)->setPincodeForm($pincodeForm);
        
        return $ctr;
    }
}


<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\ClientController;
use Customer\Entity\Customer;

/**
 *
 * @author swoopfx
 *        
 */
class ClientControllerFactory implements FactoryInterface
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
        $ctr = new ClientController();
        $customeEntity = new Customer();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $customerService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerService');
        $clientService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $newUserService = $serviceLocator->getServiceLocator()->get('CsnUser\Service\NewUserService');
        $clienttSession = $clientGeneralService->getClientSession();
        $em = $generalService->getEntityManager();
        $auth = $generalService->getAuth();
        $loginForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\ClientLoginForm');
        
        $registerForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\ClientRegisterForm');
        
        $forgotPasswordForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get(' Customer\Form\CustomerForgottenPasswordForm');
        
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $ctr->setEntityManager($em)
            ->setLoginForm($loginForm)
            ->setGeneralService($clientGeneralService)
            ->setAuth($auth)
            ->setRegisterForm($registerForm)
            ->setCustomerEntity($customeEntity)
            ->setCustomerService($customerService)
            ->setClientService($clientService)
            ->setClientGeneralService($clientGeneralService)
            ->setNewUserService($newUserService)
            ->setHiddenSession($clientGeneralService->getHiddenSession())
            ->setUserService($newUserService)
            ->setClientSession($clienttSession)
            ->setSmsService($smsService)
            ->setForgotPasswordForm($forgotPasswordForm);
        // ;
        return $ctr;
    }
}


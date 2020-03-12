<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Service\CustomerService;
use Customer\Entity\Customer;
use Customer\Entity\CustomerBroker;
use SMS\Service\SMSService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerFactory implements FactoryInterface
{

    private $auth;

    private $userRole;

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
        $service = new CustomerService();
        $customerBrokerEntity = new CustomerBroker();
        $brokerCustomerSession = new Container("broker_customer_session");
        $smsService = $serviceLocator->get('SMS\Service\SMSService');
        // $customerChildBrokerEntity = new CustomerAssignedBrokerChild();
        // $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $auth = $generalService->getAuth();
        $this->auth = $auth;
        $mailService = $generalService->getMailService();
        $urlPlugin = $generalService->getUrlPlugin();
        $urlViewHelper = $generalService->getUrlViewHelper();
        // $mailer = $serviceLocator->get("GeneralServicer\Service\MailService");
        
        $redirect = $generalService->getRedirect();
        $service->setEntityManager($em)
            ->setViewRender($generalService->getViewRender())
            ->setUserId($generalService->getUserId())
            ->setRedirect($redirect)
            ->setGeneralService($generalService)
            
            ->setAuth($auth)
            ->setCustomerBrokerEntity($customerBrokerEntity)
            ->setUserRole($generalService->getUserRoleId())
            ->setBrokerId($generalService->getBrokerId())
            ->setBrokerChild($generalService->getChildBrokerId())
            ->setMotherBroker($generalService->getMotherBrokerId())
            ->setCentralBrokerId($generalService->getCentralBroker())
            ->setSmsService($smsService)
            ->setMailService($mailService)
            ->setFlash($generalService->getFlashMessenger())
            ->setBrokerCustomerSession($brokerCustomerSession)
            ->setUrlViewhelper($urlViewHelper)
            ->setUrlPlugin($urlPlugin);
        
        return $service;
    }
}


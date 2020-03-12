<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Customer\Controller\PolicyController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

class PolicyControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PolicyController();
        
        
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $customerPolicySession = new Container("customer_policy_session");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $customerBoardService = $serviceLocator->getServiceLocator()->get("Customer\Service\CustomerBoardService");
        $policyService = $serviceLocator->getServiceLocator()->get("Policy\Service\PolicyService");
        $claimPreForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\CustomerClaimsPreForm');
        
        $renewPolicyForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\RenewPolicyForm');
        
           
        
        $em = $clientGeneralService->getEntityManager();
        $ctr->setCustomerBoardService($customerBoardService)
            ->setEntityManager($em)
            ->setCustomerPolicySession($customerPolicySession)
            ->setClientGeneralService($clientGeneralService)
            ->setRenewPolicyForm($renewPolicyForm)
            ->setClaimsPreForm($claimPreForm)
            ->setPolicyService($policyService)
            ->setRenderer($renderer);
        return $ctr;
    }
}
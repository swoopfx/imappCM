<?php
namespace Home\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Home\Controller\ActivateController;

/**
 *
 * @author otaba
 *        
 */
class ActivateControllerFactory implements FactoryInterface
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
        $ctr = new ActivateController();
        $entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        $mailService = $serviceLocator->getServiceLocator()->get('acmailer.mailservice.default');
        $brokerSetupService = $serviceLocator->getServicelocator()->get("Users\Service\BrokerSetupService");
        $activationForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Home\Form\ActivationForm");
        $activateLoginForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Home\Form\ActivateLoginForm");
        
        $ctr->setEntityManager($entityManager)
            ->setMailService($mailService)
            ->setSmsService($smsService)
            ->setActivationForm($activationForm)
            ->setActivateLoginForm($activateLoginForm)
            ->setBrokerSetupService($brokerSetupService);
        return $ctr;
    }
}


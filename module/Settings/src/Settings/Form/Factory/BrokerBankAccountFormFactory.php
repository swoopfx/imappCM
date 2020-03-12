<?php
namespace Settings\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Settings\Form\BrokerBankAccountForm;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerBankAccountFormFactory implements FactoryInterface
{

  

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new BrokerBankAccountForm();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        return $form;
    }
}


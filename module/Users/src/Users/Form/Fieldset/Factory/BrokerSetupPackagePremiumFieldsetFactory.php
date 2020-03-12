<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\BrokerSetupPackagePremiumFieldset;


/**
 *
 * @author otaba
 *        
 */
class BrokerSetupPackagePremiumFieldsetFactory implements FactoryInterface
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
        
        $fieldset = new BrokerSetupPackagePremiumFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}


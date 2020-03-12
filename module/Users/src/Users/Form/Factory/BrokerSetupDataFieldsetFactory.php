<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\BrokerSetUpDataFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupDataFieldsetFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new BrokerSetUpDataFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        return $field;
    }
}


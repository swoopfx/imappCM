<?php
namespace Policy\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Form\Fieldset\RenewPolicyFieldset;


/**
 *
 * @author otaba
 *        
 */
class RenewPolicyFieldsetFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
       
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $fieldset = new RenewPolicyFieldset();
        return $fieldset;
    }
}


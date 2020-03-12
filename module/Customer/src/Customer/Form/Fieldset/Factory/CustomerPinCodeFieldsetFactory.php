<?php
namespace Customer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\Fieldset\CustomerPinCodeFieldset;


/**
 *
 * @author otaba
 *        
 */
class CustomerPinCodeFieldsetFactory implements FactoryInterface
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
        $fieldset = new CustomerPinCodeFieldset();
        return $fieldset;
    }
}


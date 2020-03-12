<?php
namespace Customer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\Fieldset\CustomerForgotPasswordFieldset;

/**
 *
 * @author otaba
 *        
 */
class CustomerForgotPasswordFieldsetFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new CustomerForgotPasswordFieldset();
        return $fieldset;
    }
}


<?php
namespace Customer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Customer\Form\CustomerPinCodeForm;

/**
 *
 * @author otaba
 *        
 */
class CustomerPinCodeFormFactory implements  FactoryInterface
{

    /**
     */
    public function __construct()
    {}
    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $form = new CustomerPinCodeForm();
        return $form;
        
    }

}


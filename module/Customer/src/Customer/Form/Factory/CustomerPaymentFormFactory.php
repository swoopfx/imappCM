<?php
namespace Customer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\CustomerPaymentForm;


/**
 *
 * @author otaba
 *        
 */
class CustomerPaymentFormFactory implements FactoryInterface
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
        $form= new CustomerPaymentForm();
        return $form;
    }
}


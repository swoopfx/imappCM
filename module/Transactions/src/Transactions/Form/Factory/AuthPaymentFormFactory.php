<?php
namespace Transactions\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\AuthPaymentForm;


/**
 *
 * @author otaba
 *        
 */
class AuthPaymentFormFactory implements FactoryInterface
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
        
        $form =  new AuthPaymentForm();
        return $form;
    }
}


<?php
namespace Customer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\CustomerForgottenPasswordForm;


/**
 *
 * @author otaba
 *        
 */
class CustomerForgotPasswordFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new CustomerForgottenPasswordForm();
        return $form;
    }
}


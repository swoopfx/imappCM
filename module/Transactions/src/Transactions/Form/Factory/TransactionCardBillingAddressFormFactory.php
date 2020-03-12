<?php
namespace Transactions\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\TransactionCardBillingAddressForm;


/**
 *
 * @author otaba
 *        
 */
class TransactionCardBillingAddressFormFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new TransactionCardBillingAddressForm();
        return $form;
    }
}


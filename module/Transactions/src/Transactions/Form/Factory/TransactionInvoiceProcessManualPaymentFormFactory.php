<?php
namespace Transactions\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\TransactionInvoiceProcessManualPaymentForm;


/**
 *
 * @author otaba
 *        
 */
class TransactionInvoiceProcessManualPaymentFormFactory implements FactoryInterface
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
        $form = new TransactionInvoiceProcessManualPaymentForm();
        return $form;
    }
}


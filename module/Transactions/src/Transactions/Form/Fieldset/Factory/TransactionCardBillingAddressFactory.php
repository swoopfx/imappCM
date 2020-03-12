<?php
namespace Transactions\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\Fieldset\TransactionCardBillingAddress;


/**
 *
 * @author otaba
 *        
 */
class TransactionCardBillingAddressFactory implements FactoryInterface
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
        
        $fieldset = new TransactionCardBillingAddress();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $fieldset->setEntityManager($generalService->getEntityManager());
        return $fieldset;
    }
}


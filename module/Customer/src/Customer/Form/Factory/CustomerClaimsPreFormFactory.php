<?php
namespace Customer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\CustomerClaimsPreForm;


/**
 *
 * @author otaba
 *        
 */
class CustomerClaimsPreFormFactory implements FactoryInterface
{

    
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
       $form = new CustomerClaimsPreForm();
//        $ServiceManager = $serviceLocator->getServicelocator();
//        $form->setServiceManager($ServiceManager);
       return $form;
    }
}


<?php
namespace BrokersTool\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\StaffPhoneNumberForm;


/**
 *
 * @author otaba
 *        
 */
class StaffPhoneNumberFormFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
       $form = new StaffPhoneNumberForm();
       return $form;
       
    }
}


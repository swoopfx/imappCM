<?php
namespace Policy\Form\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Form\PolicyPremiumPayableForm;

class PolicyPremiumPayableFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new PolicyPremiumPayableForm();
        return $form;
    }


    
}


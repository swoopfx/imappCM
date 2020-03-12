<?php
namespace Claims\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\ClaimsFidelityGaurateeForm;

class ClaimsFidelityGaurateeFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new ClaimsFidelityGaurateeForm();
        
        return $form;
    }
}


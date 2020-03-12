<?php
namespace Claims\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\ClaimsContractorAllRiskForm;

class ClaimsContractorsAllRiskFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $form = new ClaimsContractorAllRiskForm();
        return $form;
    }
}


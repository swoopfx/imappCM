<?php
namespace Claims\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\ClaimsExportClaimsForm;

class ClaimsExportClaimsFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

       $form = new ClaimsExportClaimsForm();
       return $form;
    }
}


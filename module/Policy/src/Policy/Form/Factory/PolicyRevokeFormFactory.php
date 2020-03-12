<?php
namespace Policy\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Form\PolicyRevokeForm;

class PolicyRevokeFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $form = new PolicyRevokeForm();
        return $form;
    }
}


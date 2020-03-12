<?php
namespace Wallet\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Wallet\Form\Fieldset\WalletPasscodeFieldset;

class WalletPasscodeFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new WalletPasscodeFieldset();return $fieldset;
    }
}


<?php
namespace Wallet\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Wallet\Form\WalletAddFundsForm;

class WalletAddFundFormFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $form = new WalletAddFundsForm();
        return $form;
    }
}


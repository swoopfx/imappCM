<?php
namespace Help\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Help\Controller\HelpController;

class HelpControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new HelpController();
        return $ctr;
    }
}


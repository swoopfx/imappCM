<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\PortalService;

class PortalServiceFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $xserv = new PortalService();
        $generalService =  $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
        return $xserv;
    }
}


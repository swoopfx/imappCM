<?php
namespace Webhook\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Webhook\Controller\InitiatebrokertransferController;

class InitiatebrokertransferControllerFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $ctr = new InitiatebrokertransferController();
//         $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        return $ctr;
    }
}


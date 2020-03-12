<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\BrokerGeneralService;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerGeneralServiceFactory implements FactoryInterface
{

    private $auth;

    public function __construct()
    {}

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new BrokerGeneralService();
        $generalServie = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalServie->getEntityManager();
        $this->auth = $generalServie->getAuth();
        // $redirect = $serviceLocator->get('ControllerPluginManager')->get('redirectPlugin');
        
        $service->setEntityManager($em)
            ->setGeneralService($generalServie)
            ->setUserId($generalServie->getUserId())
            ->setUserRoleId($generalServie->getUserRoleId())
            ->setBrokerId($generalServie->getBrokerId())
            ->setAuth($this->auth);
        return $service;
    }
}


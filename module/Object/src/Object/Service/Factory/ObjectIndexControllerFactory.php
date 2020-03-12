<?php
namespace Object\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectIndexControllerService;
use Object\Entity\ObjectMotorData;
use Object\Entity\Object;


/**
 *
 * @author swoopfx
 *        
 */
class ObjectIndexControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectEntity = new Object();
        $service = new ObjectIndexControllerService();
        $motorEntity = new ObjectMotorData();
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $objectService = $serviceLocator->get('object_service_main');
        $service->setObjectUid($objectService);
        $redirect = $serviceLocator
        ->get('ControllerPluginManager')
        ->get('redirect');
        
        $service->setRedirect($redirect);
        $service->setEntityManager($em);
        $service->setUserId($auth);
        $service->setObjectEntity($objectEntity);
        $service->setMotorEntity($motorEntity);
        return $service;
    }
}


<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\UsersService;


/**
 *
 * @author swoopfx
 *        
 */
class UsersFactory implements FactoryInterface
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
        $service = new UsersService();
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $service->setUserId($auth);
        $service->setEntityManager($em);
        return $service;
    }
}


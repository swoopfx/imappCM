<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\RegisterService;
use CsnUser\Entity\User;

/**
 *
 * @author swoopfx
 *        
 */
class RegisterServiceFactory implements FactoryInterface
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
        $service = new RegisterService();
        $userEntity = new User();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        
        $pluginManager = $serviceLocator->get('ControllerPluginManager');
        
        $redirect = $pluginManager->get('redirect');
        
        $service->setEntityManager($em)
            ->setUserEntity($userEntity)
            ->setRedirect($redirect);
        return $service;
    }
}


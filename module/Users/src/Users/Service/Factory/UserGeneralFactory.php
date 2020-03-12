<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\UserGeneralService;

/**
 *
 * @author swoopfx
 *        
 */
class UserGeneralFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new UserGeneralService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $service->setEntityManager($em);
        return $service;
    }
}

?>
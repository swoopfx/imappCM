<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\DashBoardService;

/**
 *
 * @author swoopfx
 *        
 */
class DashBoardFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dash = new DashBoardService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $dash->setEntityManager($em);
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $dash->setAuth($auth);
        return $dash;
    }
}


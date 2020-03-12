<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\FileManagerService;

/**
 *
 * @author swoopfx
 *        
 */
class FileManagerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fileMAnager = new FileManagerService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $fileMAnager->setEntityManager($em);
        $fileMAnager->setUserIdentity($auth);
        
        return $fileMAnager;
    }
}

?>
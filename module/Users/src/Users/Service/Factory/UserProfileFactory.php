<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\UserProfileService;

/**
 *
 * @author swoopfx
 *        
 */
class UserProfileFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $userProfile = new UserProfileService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        
        $userProfile->setEntityManager($em);
        
        $userProfile->setAuth($auth);
        
        return $userProfile;
    }
}

?>
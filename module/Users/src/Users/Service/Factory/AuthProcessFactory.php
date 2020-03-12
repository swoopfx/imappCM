<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\AuthProcessService;
use Users\Entity\User;

/**
 *
 * @author swoopfx
 *        
 */
class AuthProcessFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authProcess = new AuthProcessService();
        $user = new User();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $tr = $serviceLocator->get('MvcTranslator');
        $op = $serviceLocator->get('users_module_options');
        $as = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        // $ev = $serviceLocator->get('users_error_view');
        $authProcess->setEntityManager($em);
        $authProcess->setAuthService($as);
        $authProcess->setOptions($op);
        $authProcess->setOptions($op);
        $authProcess->setUserEntity($user);
        
        return $authProcess;
    }
}

?>
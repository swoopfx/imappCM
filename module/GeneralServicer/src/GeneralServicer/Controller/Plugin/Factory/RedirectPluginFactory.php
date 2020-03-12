<?php
namespace GeneralServicer\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Controller\Plugin\RedirectPlugin;

/**
 *
 * @author swoopfx
 *        
 */
class RedirectPluginFactory implements FactoryInterface
{

    protected $auth;

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $plugin = new RedirectPlugin();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $auth = $generalService->getAuth();
        $plugin->setAuth($auth);
        
        $redirect = $serviceLocator->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('redirect');
        $setupRedirection = $serviceLocator->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('setupRedirectPlugin');
        
        $flashMessenger = $serviceLocator->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('FlashMessenger');
        
        $plugin->setUpRedirect($setupRedirection);
        
        $plugin->setRedirect($redirect)
            ->setFlash($flashMessenger)
            ->setOptions($op)
            ->setEntityManager($em);
        
        return $plugin;
    }
}

?>
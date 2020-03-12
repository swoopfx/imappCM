<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\HelperPluginManager;
use Authorization\Acl\Acl;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $em = $app->getEventManager();
        
        $listener = $sm->get(\ZfcRbac\View\Strategy\UnauthorizedStrategy::class);
        $listener->attach($em);
        
        
        $listener = $sm->get(\ZfcRbac\View\Strategy\RedirectStrategy::class);
        $listener->attach($em);
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {

        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }
    
    public function getViewHelperConfig()
    {
//         var_dump($expression)
        return array(
            'factories' => array(
                // This will overwrite the native navigation helper
                'mnavigation' => function (HelperPluginManager $pm) {
                $sm = $pm->getServiceLocator();
                $config = $sm->get('config');
                
                // $acl = $sm->get('acl');
                
                $acl = new Acl($config);
                
                $auth = $sm->get('Zend\Authentication\AuthenticationService');
                $role = \Authorization\Acl\Acl::DEFAULT_ROLE;
//                 var_dump($role);
                if ($auth->hasIdentity()) {
                    $user = $auth->getIdentity();
                    var_dump($user->getId());
                    $role = $user->getRole()->getName();
                    //                         var_dump($role);
                }
                // var_dump("ERTT");
                // var_dump($role);
                // Get an instance of the proxy helper
                $navigation = $pm->get('Zend\View\Helper\Navigation');
                
                // Store ACL and role in the proxy helper:
                $navigation->setAcl($acl)->setRole($role);
                
                // Return the new navigation helper instance
                return $navigation;
                }
                )
            );
    }
    
   
}

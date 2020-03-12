<?php
namespace Home;

use Zend\ModuleManager\ModuleManager;

class Module
{

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

//     public function init(ModuleManager $moduleManager)
//     {
//         $sharedEvent = $moduleManager->getEventManager()->getSharedManager();
//         $sharedEvent->attach(__NAMESPACE__, 'dispatch', function ($e) {
//             $controller = $e->getTarget();
//             $controller->layout('layout/layout.phtml');
//         });
//     }
}

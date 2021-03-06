<?php
namespace Webhook;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface{
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
    
    public function onBootstrap(MvcEvent $e){
        $app = $e->getApplication();
        
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
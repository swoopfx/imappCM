<?php
/**
 * This module handles the specifics of the types of services rendered by the application 
 * e.g handling of motor insurance, property insurance 
 * That is insurance specific services 
 */
namespace IMServices;

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
}

<?php
namespace Home\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Home\Service\HomeService;

/**
 *
 * @author swoopfx
 *        
 */
class HomeServiceFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        // TODO - Insert your code here
        $homeService = new HomeService();
        $gs = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $pluginManager = $serviceLocator->get('ControllerPluginManager');
        $homeService->setGeneralService($gs)->setPluginManager($pluginManager);
        return $homeService;
    }
}

?>
<?php
namespace Settings\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Settings\Service\SettingsService;


/**
 *
 * @author swoopfx
 *        
 */
class SettingsServiceFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $xserv = new SettingsService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em= $generalService->getEntityManager();
        $xserv->setEntityManager($em);
        return $xserv;
    }
}


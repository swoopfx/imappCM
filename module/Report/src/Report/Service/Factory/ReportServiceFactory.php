<?php
namespace Report\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Report\Service\ReportService;


/**
 *
 * @author swoopfx
 *        
 */
class ReportServiceFactory implements FactoryInterface
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
        
        $xser = new ReportService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
        $xser->setGeneralService($generalService);
        return $xser;
    }
}


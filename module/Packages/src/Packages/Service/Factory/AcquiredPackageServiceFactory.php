<?php
namespace Packages\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Service\AcquirePackagesService;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class AcquiredPackageServiceFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $acquiredPackageService = new AcquirePackagesService();
        $acquiredPackageSession = new Container("acquiredPackage");
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $acquiredPackageService->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setAcquiredPackageSession($acquiredPackageSession);
        return $acquiredPackageService;
    }
}


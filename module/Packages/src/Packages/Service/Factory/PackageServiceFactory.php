<?php
namespace Packages\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Service\PackageService;

/**
 *
 * @author otaba
 *        
 */
class PackageServiceFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xser = new PackageService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $centralBrokerid = $generalService->getCentralBroker();
        $em = $generalService->getEntityManager();
        $userId = $generalService->getUserId();
        $redirect = $generalService->getRedirect();
        $flash = $generalService->getFlashMessenger();
        $xser->setEntityManager($em)
            ->setCentralBrokerId($centralBrokerid)
            ->setRedirect($redirect)
            ->setFlash($flash)
            ->setUserId($userId);
        return $xser;
    }
}


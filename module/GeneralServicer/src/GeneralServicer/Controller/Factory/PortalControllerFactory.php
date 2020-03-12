<?php
namespace GeneralServicer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Controller\PortalController;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class PortalControllerFactory implements FactoryInterface
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
        $ctr = new PortalController();
        $puidSession = new Container("piudSession");
        $puidSession->setExpirationSeconds(10800);
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $portalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\PortalService");
        $em = $generalService->getEntityManager();
        $renderer = $generalService->getViewRender();
        $ctr->setEntityManager($em)
            ->setRenderer($renderer)
            ->setPuidSession($puidSession)->setPortalService($portalService);
        return $ctr;
    }
}


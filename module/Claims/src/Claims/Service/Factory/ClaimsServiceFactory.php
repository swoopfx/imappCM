<?php
namespace Claims\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Service\ClaimsService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsServiceFactory implements FactoryInterface
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
        $xserv = new ClaimsService();
        $claimsProcessSession = new Container("CustomerClaimsSession");
        $brokerClaimsSession = new Container("brokerClaimsSession");
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $xserv->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setCentralBrokerId($centralBrokerId)
            ->setCustomerClaimsSession($claimsProcessSession)
            ->setBrokerClaimsSession($brokerClaimsSession);
        return $xserv;
    }
}


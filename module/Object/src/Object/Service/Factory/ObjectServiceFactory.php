<?php
namespace Object\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Service\ObjectService;

use Zend\Session\Container;
use Object\Entity\Object;

class ObjectServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectService = new ObjectService();
        $objectEntity = new Object();
        $objectSession = new Container("objectSession");
        $objectSession->setExpirationSeconds(60 * 60 * 24);
        
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $cureenctService = $serviceLocator->get('GeneralServicer\Service\CurrencyService');
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $objectService->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setUserId($generalService->getUserId())
            ->setAuth($generalService->getAuth())
            ->setUserRoleId($generalService->getUserRoleId())
            ->setBrokerId($generalService->getBrokerId())
            ->setMotherBrokerId($generalService->getMotherBrokerId())
            
            ->setCurrencyService($cureenctService)
            ->setObjectSession($objectSession)
            ->setCentralBrokerId($centralBrokerId);
        
        return $objectService;
    }
}
<?php
namespace Offer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Service\OfferService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class OfferFactory implements FactoryInterface
{

    private $userId;

    private $auth;

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
        $offer = new OfferService();
        $offerSession = new Container("offerSession");
        $offerSession->setExpirationSeconds(60 * 60 * 24);
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $mailService = $generalService->getMailService();
        $em = $generalService->getEntityManager();
        $this->auth = $generalService->getAuth();
        $userId = $generalService->getUserId();
        
        $centraBroker = $generalService->getCentralBroker();
        $offer->setUserId($userId)
            ->setEntityManager($em)
            ->setCentralBroker($centraBroker)
            ->setOfferSession($offerSession)
            ->setMailService($mailService);
        
        return $offer;
    }
}


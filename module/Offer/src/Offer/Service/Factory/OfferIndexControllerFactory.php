<?php
namespace Offer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Service\OfferIndexControllerService;
use Zend\Session\Container;


/**
 *
 * @author swoopfx
 *        
 */
class OfferIndexControllerFactory implements FactoryInterface
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
        $time = \time();
        $offer = new OfferIndexControllerService();
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $sess = new Container('offer_form');
        $offerService = $serviceLocator->get('Offer\Service\OfferService');
        
        $offer->setEntityManager($em);
        $code = $offerService->generateOfferCode();
        $offer->setOfferCode($code);
        $offer->setUserId($auth);
        
        $offer->setSession($sess);
        return $offer;
    }
}


<?php
namespace Policy\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\CoverNoteService;
use Zend\Session\Container;

/**
 *
 * @author otaba
 *        
 */
class ConerNoteServiceFactory implements FactoryInterface
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
        $coverNoteService = new CoverNoteService();
        $coverNoteSession  = new Container("coverNoteSession");
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $mailService = $generalService->getMailService();
        $coverNoteService->setCoverNoteSession($coverNoteSession)->setMailService($mailService);
        return $coverNoteService;
    }
}


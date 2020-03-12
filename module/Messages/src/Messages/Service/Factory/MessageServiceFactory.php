<?php
namespace Messages\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Messages\Service\MessageService;


/**
 *
 * @author otaba
 *        
 */
class MessageServiceFactory implements FactoryInterface
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
        $xserv = new MessageService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $xserv->setEntityManager($em);
        return $xserv;
    }
}


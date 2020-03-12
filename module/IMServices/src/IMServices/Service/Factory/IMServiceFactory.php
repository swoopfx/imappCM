<?php
namespace IMServices\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Service\IMService;


/**
 *
 * @author otaba
 *        
 */
class IMServiceFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $xserv = new IMService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $formManager = $serviceLocator->get("FormElementManager");
        
        $xserv->setFormManager($formManager)->setEntityManager($em)->setGeneralService($generalService);
        return $xserv;
    }
}


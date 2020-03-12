<?php
namespace Job\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Job\Service\PaymentJobService;


/**
 *
 * @author otaba
 *        
 */
class PaymentJobServiceFactory implements FactoryInterface
{

   
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $xserv = new PaymentJobService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $xserv->setEntiyManager($em);
        return $xserv;
    }
}


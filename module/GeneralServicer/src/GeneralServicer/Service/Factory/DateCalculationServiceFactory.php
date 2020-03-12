<?php
namespace GeneralServicer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\DateCalculationService;

/**
 *
 * @author swoopfx
 *        
 */
class DateCalculationServiceFactory implements FactoryInterface
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
        $xserv = new DateCalculationService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $centralBroker = $generalService->getCentralBroker();
        $brokerSub = $generalService->getSubscription();
        $endDate = NULL;
        if($brokerSub != NULL){
        $endDate = $brokerSub->getEndDate();
        }
        $xserv->setEntityManager($em)->setSubsEndDate($endDate);
        return $xserv;
    }
    
  
}


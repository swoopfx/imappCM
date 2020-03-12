<?php
namespace IMServices\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\LiveStockFarmInsuranceFieldset;


/**
 *
 * @author otaba
 *        
 */
class LiveStockFarmInsuranceFieldsetFactory implements FactoryInterface
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
        
       $fieldset = new LiveStockFarmInsuranceFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
       $fieldset->setEntityManager($generalService->getEntityManager());
       return $fieldset;
    }
}


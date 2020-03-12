<?php
namespace IMServices\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\Fieldset\HomeHouseholdGoodsFieldset;


/**
 *
 * @author otaba
 *        
 */
class HomeHouseholdGoodsFieldsetFactory implements FactoryInterface
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
        
       $fieldset = new HomeHouseholdGoodsFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
       $fieldset->setEntityManager($generalService->getEntityManager());
       return $fieldset;
    }
}


<?php
namespace Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\ObjectExtraAirConditionFieldset;


/**
 *
 * @author otaba
 *        
 */
class ObjectExtraConditionFieldsetFactory implements FactoryInterface
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
        
        $field = new ObjectExtraAirConditionFieldset();
        $generalService  = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $field->setEntityManager($em);
        return $field;
    }
}


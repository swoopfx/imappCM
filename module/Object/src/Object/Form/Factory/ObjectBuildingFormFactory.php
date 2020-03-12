<?php
namespace Object\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\ObjectBuildingForm;


/**
 *
 * @author otaba
 *        
 */
class ObjectBuildingFormFactory implements FactoryInterface
{

   

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new ObjectBuildingForm();
        return $form;
        
    }
}


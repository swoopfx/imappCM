<?php
namespace SMS\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SMS\Form\Fieldset\SMSUnitFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class SMSUnitFieldsetFactory implements FactoryInterface
{

   
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
       $fieldset = new SMSUnitFieldset();
       return $fieldset;
    }
}


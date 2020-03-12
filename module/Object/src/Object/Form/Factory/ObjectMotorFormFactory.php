<?php
namespace Object\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\ObjectMotorForm;


/**
 *
 * @author otaba
 *        
 */
class ObjectMotorFormFactory implements FactoryInterface
{

   

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
       $form = new ObjectMotorForm();return $form;
    }
}


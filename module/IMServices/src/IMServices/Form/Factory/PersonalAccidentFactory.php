<?php
namespace IMServices\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\PersonalAccidentForm;

/**
 *
 * @author otaba
 *        
 */
class PersonalAccidentFactory implements FactoryInterface
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
        
        $form = new PersonalAccidentForm();
        return $form;
    }
}


<?php
namespace Customer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\Fieldset\LoginFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class LoginFieldsetFactory implements FactoryInterface
{

    
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new LoginFieldset();
        return $field;
    }
}


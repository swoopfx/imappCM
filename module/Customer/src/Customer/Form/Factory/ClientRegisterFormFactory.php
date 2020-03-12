<?php
namespace Customer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\ClientRegisterForm;

/**
 *
 * @author swoopfx
 *        
 */
class ClientRegisterFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new ClientRegisterForm();
        return $form;
    }
}


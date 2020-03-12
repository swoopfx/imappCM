<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\BrokerSetUpDataForm;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetUpDataFormFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new BrokerSetUpDataForm();
        return $form;
    }
}


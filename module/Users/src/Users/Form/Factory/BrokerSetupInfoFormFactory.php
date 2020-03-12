<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\BrokerSetupInfoForm;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupInfoFormFactory implements FactoryInterface
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
        $form = new BrokerSetupInfoForm();
        
        return $form;
    }
}


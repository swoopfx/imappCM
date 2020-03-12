<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\BrokerSetupPackageForm;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupPackageFormFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        $form = new BrokerSetupPackageForm();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new BrokerSetupPackageForm();
        
        return $form;
    }
}


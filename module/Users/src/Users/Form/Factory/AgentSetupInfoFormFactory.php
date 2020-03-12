<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\AgentSetupInfoForm;


/**
 *
 * @author swoopfx
 *        
 */
class AgentSetupInfoFormFactory implements FactoryInterface
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
        $form = new AgentSetupInfoForm();
        return $form;
    }
}


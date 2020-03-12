<?php
namespace BrokersTool\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\BrokerChildProfileForm;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerChildProfileFormFactory implements FactoryInterface
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
        
        $form = new BrokerChildProfileForm();
        return $form;
    }
}


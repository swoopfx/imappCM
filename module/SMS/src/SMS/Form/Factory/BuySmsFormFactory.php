<?php
namespace SMS\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SMS\Form\BuySmsForm;

/**
 *
 * @author swoopfx
 *        
 */
class BuySmsFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new BuySmsForm();
        return $form;
    }
}


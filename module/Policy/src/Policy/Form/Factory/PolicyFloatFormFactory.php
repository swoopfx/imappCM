<?php
namespace Policy\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Form\PolicyFloatForm;

/**
 *
 * @author otaba
 *        
 */
class PolicyFloatFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new PolicyFloatForm();
        
        return $form;
    }
}


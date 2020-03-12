<?php
namespace IMServices\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\FidelityGuarateeForm;


/**
 *
 * @author otaba
 *        
 */
class FidelityGuaranteeFormFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new FidelityGuarateeForm();
        return $form;
    }
}


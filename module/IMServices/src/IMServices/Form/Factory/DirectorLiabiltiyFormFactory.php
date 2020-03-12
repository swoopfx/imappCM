<?php
namespace IMServices\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IMServices\Form\DirectorsLiabilityForm;


/**
 *
 * @author otaba
 *        
 */
class DirectorLiabiltiyFormFactory implements FactoryInterface
{

   

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new DirectorsLiabilityForm();
        return $form;
    }
}


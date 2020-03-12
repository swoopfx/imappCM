<?php
namespace GeneralServicer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Form\Fieldset\ExportToInsurerFieldset;


/**
 *
 * @author otaba
 *        
 */
class ExportToInsurerFieldsetFactory implements FactoryInterface
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
        
        $fieldset = new ExportToInsurerFieldset();
        
        return $fieldset;
    }
}


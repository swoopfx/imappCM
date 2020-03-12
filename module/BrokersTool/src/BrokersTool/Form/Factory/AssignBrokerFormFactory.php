<?php
namespace BrokersTool\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use BrokersTool\Form\AssignBrokerForm;


/**
 *
 * @author otaba
 *        
 */
class AssignBrokerFormFactory implements FactoryInterface
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
        $form = new AssignBrokerForm();
        return $form;
    }
}


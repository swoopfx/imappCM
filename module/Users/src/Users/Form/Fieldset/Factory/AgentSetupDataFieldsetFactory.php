<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\AgentSetupDataFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class AgentSetupDataFieldsetFactory implements FactoryInterface
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
        
        $field = new AgentSetupDataFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $field->setEntityManager($em);
        return $field;
    }
}


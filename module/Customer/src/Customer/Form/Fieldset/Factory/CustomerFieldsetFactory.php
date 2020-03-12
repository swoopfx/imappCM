<?php
namespace Customer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\Fieldset\CustomerFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class CustomerFieldsetFactory implements FactoryInterface
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
        $fieldset = new CustomerFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        
        return $fieldset;
    }
}


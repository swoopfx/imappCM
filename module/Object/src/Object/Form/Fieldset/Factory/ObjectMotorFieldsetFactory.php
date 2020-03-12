<?php
namespace Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\ObjectMotorFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class ObjectMotorFieldsetFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new ObjectMotorFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $field->setEntityManager($em);
        return $field;
    }
}

?>
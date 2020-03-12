<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\BrokerSetUpDataFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetUpDataFieldsetFactroy implements FactoryInterface
{

  
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new BrokerSetUpDataFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        return $fieldset;
       
    }
}



<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\BrokerBankAccountFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerBankAccountFieldsetFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new BrokerBankAccountFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entityManager.orm_default');
        $field->setEntityManager($em);
        return $field;
    }
}


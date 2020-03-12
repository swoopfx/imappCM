<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Users\Form\Fieldset\BrokerSetupPackageFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupPackageFieldsetFactory implements FactoryInterface
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
        $field = new BrokerSetupPackageFieldset();
        
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $cureencyFormat = $serviceLocator->getServicelocator()->get("ViewHelperManager")->get("myCurrencyFormat");
        $field->setEntityManager($em)->setCurrencyFormat($cureencyFormat);
        return $field;
    }
}


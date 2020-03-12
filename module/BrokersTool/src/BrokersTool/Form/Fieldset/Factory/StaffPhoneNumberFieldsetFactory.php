<?php
namespace BrokersTool\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\Fieldset\StaffPhoneNumberFieldset;


/**
 *
 * @author otaba
 *        
 */
class StaffPhoneNumberFieldsetFactory implements FactoryInterface
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
        
       $fieldset = new StaffPhoneNumberFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
       $fieldset->setEntityManager($generalService->getEntityManager());
       return $fieldset;
    }
}


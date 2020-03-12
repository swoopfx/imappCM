<?php
namespace Claims\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsDefaultFieldset;

/**
 *
 * @author otaba
 *        
 */
class ClaimsDefaultFieldsetFactory implements FactoryInterface
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
      
       $fieldset = new ClaimsDefaultFieldset();
       $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
       $em = $clientGeneralService->getEntityManager();
       $fieldset->setEntityManager($em);
       return $fieldset;
    }
}


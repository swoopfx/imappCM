<?php
namespace Claims\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsLossListFieldset;

class ClaimsLossFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ClaimsLossListFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
        
    }
}


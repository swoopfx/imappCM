<?php
namespace Claims\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsApprovedFieldset;

class ClaimsApprovedFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ClaimsApprovedFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}


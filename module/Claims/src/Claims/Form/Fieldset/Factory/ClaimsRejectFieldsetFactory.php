<?php
namespace Claims\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsRejectedFieldset;

class ClaimsRejectFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ClaimsRejectedFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
//         $em = $clientGeneralService->getEntityManager();
        return $fieldset;
    }
}


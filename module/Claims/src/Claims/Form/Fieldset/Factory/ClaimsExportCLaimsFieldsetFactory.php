<?php
namespace Claims\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Form\Fieldset\ClaimsExportClaimsFieldset;

class ClaimsExportCLaimsFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ClaimsExportClaimsFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $clientGeneralService->getEntityManager();
//         $fieldset->setEntityManager($em);
        return $fieldset;
   }
}


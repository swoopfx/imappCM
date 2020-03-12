<?php
namespace Customer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Form\Fieldset\CustomerClaimsPreFieldset;


/**
 *
 * @author otaba
 *        
 */
class CustomerClaimsPreFieldsetFactory implements FactoryInterface
{

   
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new CustomerClaimsPreFieldset();
        $clientGeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
        $em = $clientGeneralService->getEntityManager();
        $customerId = $clientGeneralService->getCustomerId();
        $field->setEntityManager($em)->setCustomerId($customerId);
        return $field;
    }
}


<?php
namespace BrokersTool\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\Fieldset\CustomerMessageFieldset;

class CustomerMessageFeildsetFactory implements FactoryInterface {
	
	
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$field = new CustomerMessageFieldset();
		$clientSeneralService = $serviceLocator->getServiceLocator()->get("Customer\Service\ClientGeneralService");
		$em = $clientSeneralService->getEntityManager();
		$field->setEntityManager($em);
		return $field;
	}
	
}
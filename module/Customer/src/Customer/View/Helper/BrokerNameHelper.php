<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BrokerNameHelper extends AbstractHelper implements  ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	/**
	 * This gets the broker Name independently from the session Id 
	 */
	public function __invoke(){
		$clientService = $this->getServiceLocator()->getServiceLocator()->get("Customer\Service\ClientGeneralService");
		return $clientService->getBrokerName();
	}
	
	public function getServiceLocator(){
		 return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
	
	
}
<?php
namespace Customer\View\Helper\Board;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class CustomerPolicyHelper extends  AbstractHelper implements ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	
	public function __invoke(){
		
	}
	
	private function faramu(){
		
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator($serviceLocator){
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}
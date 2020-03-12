<?php
namespace Customer\View\Helper\Board;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FeaturedPackagesSlideHelper extends  AbstractHelper implements ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	public function __invoke(){
		$em = $this->getServiceLocator()->getServiceLocator()->get("doctrine.entitymanager.orm_default");
		$boardService = $this->getServiceLocator()->getServiceLocator()->get("Customer\Service\CustomerBoardService");
		/**
		 * Get an image slider teplate 
		 */
	}
	
	private function faramu(){
		$frame = "";
		
		return $frame;
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}
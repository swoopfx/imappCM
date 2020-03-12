<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\OffsetController;
use Customer\Service\ClientGeneralService;

class OffsetControllerFactory implements FactoryInterface{
	
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$ctr = new OffsetController();
		$clientGeneralServie = new ClientGeneralService();
		return $ctr;
	}
}
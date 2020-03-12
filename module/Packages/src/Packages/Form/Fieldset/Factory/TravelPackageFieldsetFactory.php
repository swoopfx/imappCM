<?php
namespace  Packages\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Form\Fieldset\TravelPackageFieldset;

class TravelPackageFieldsetFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$feildset = new TravelPackageFieldset();
		$generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
		$em = $serviceLocator->getEntityManager();
		$feildset->setEntityManager($em);
		return $feildset;
	}
}
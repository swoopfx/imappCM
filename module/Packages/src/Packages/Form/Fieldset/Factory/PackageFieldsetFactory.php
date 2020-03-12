<?php
namespace Packages\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Form\Fieldset\PackageFieldset;

class PackageFieldsetFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$fieldset = new PackageFieldset();
		$generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
		$em = $generalService->getEntityManager();
		$fieldset->setEntityanager($em);
		return $fieldset;
	}
}
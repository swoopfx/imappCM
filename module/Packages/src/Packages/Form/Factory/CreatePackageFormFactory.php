<?php
namespace Packages\Form\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Form\CreatePackagesForm;

class CreatePackageFormFactory implements  FactoryInterface{
	
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$form = new CreatePackagesForm();
		return $form ;
	}
}
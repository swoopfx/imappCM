<?php
namespace GeneralServicer\Form\Fieldset\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Form\Fieldset\UploadFieldset;

class UploadFieldsetFactory implements  FactoryInterface{
	
	
	public function  createService(ServiceLocatorInterface $serviceLocator){
		$field = new UploadFieldset();
		return $field;
	}
}
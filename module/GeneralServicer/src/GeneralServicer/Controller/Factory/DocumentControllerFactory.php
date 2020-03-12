<?php
namespace GeneralServicer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Controller\DocumentController;

class DocumentControllerFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$ctr = new DocumentController();
		$uploadForm = $serviceLocator->getServiceLocator()->get("FormElementManager")->get("GeneralServicer\Form\GenericUploadForm");
		$ctr->setUploadForm($uploadForm);
		return $ctr;
	}
}
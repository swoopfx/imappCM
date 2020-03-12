<?php
namespace GeneralServicer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InsurerLogoHelper extends  AbstractHelper implements  ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	
	public function __invoke($insurerId){
		$generalService = $this->getServiceLocator()->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
		$basePath = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("basePath");
		//$url = $generalService->getUrlViewHelper();
		$em = $generalService->getEntityManager();
		$path = "";
		if($insurerId != NULL){
			$data = $em->find("Settings\Entity\Insurer", $insurerId);
			if($data->getLogo() == NULL || $data->getLogo() == ""){
				$path = $basePath("img/insure-logo/no_image_available_s_large.jpg");
			}else{
			    $path = $basePath("img/insure-logo/".$data->getLogo());
			}
		}
		return $path;
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}
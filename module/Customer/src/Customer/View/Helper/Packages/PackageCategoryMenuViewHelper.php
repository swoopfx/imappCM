<?php
namespace  Customer\View\Helper\Packages;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PackageCategoryMenuViewHelper extends  AbstractHelper implements ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	public function __invoke(){
		$em = $this->getServiceLocator()->getServiceLocator()->get("doctrine.entitymanager.orm_default");
		$url = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("url");
		$packageCategory = $em->getRepository("Settings\Entity\InsuranceServiceType")->findAll();
		$rr = $this->catg($packageCategory, $url);
		return $rr;
	}
	
	private function catg($cats, $url){
		$menu = "";
		foreach ($cats as $cat){
			$menu .= "<li class='list-group-item'><a class='link-text-color'
						href=". $url('cus_pack/default', array("action"=>"index", "id"=>$cat->getId())).">".$cat->getInsuranceService()."</a></li>";
		}
		return $menu;
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}
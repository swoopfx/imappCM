<?php
namespace Customer\View\Helper\Board;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardActivePackageValueTypeHelper extends  AbstractHelper implements  ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	public function __invoke($packageId){
		$em = $this->getServiceLocator()->getServiceLocator()->get("doctrine.entitymanager.orm_default");
		$packageEntity = $em->find("Packages\Entity\Packages", $packageId);
		
		$valueRep = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("package_value_representation");
		$string = NULL;
		if($packageEntity->getValueType()->getId() == 1){
			$string = "<div class='text-display-1 text-green-300'>".$valueRep($packageEntity->getValueType()->getId(), $packageEntity->getValue(), $packageEntity->getCurrency()->getCode() )."</div>
								<span class='caption text-light'>".$packageEntity->getValueType()->getType()."</span>";
		}elseif ($packageEntity->getValueType()->getId() == 2){
			$string = "<div class='text-display-1 text-red-300'>".$valueRep($packageEntity->getValueType()->getId(), $packageEntity->getValue(), $packageEntity->getCurrency()->getCode())."</div>
								<span class='caption text-light'>".$packageEntity->getValueType()->getType()."</span>";
			
		}
		
		return $string;
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;
				return $this;
	}
	
	
// 	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
// 		$this->serviceLocator = $serviceLocator;
// 		return $this;
// 	}
}
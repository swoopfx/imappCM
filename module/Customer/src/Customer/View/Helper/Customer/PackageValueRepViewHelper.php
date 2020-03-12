<?php
namespace Customer\View\Helper\Customer;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Thi is just for Displaying the neccesary value Type 
 * @author otaba
 *
 */
class PackageValueRepViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface{
	
	private $serviceLocator;
	
	/**
	 * If the Package Category is Percentage  attach the percentile sign to the end of the value
	 * If The Package Category is Absolute call the my cusrrency view helper that returns the whole string
	 * 
	 * @param unknown $packageCat // valueType
	 * @param unknown $value
	 * @param string $currency
	 * @return string
	 */
	public function __invoke($packageCat, $value, $currency = "NGN"){
		$currenctFormat = $this->getServiceLocator()->getServiceLocator()->get("ViewHelperManager")->get("myCurrencyFormat");
		$str = "";
		if($packageCat == "2"){ // percentage things 
			$str = $value."&#37;";
		}elseif ($packageCat == "1"){ // return absolute value
			$str = $currenctFormat($value, $currency); // get Currency view helper 
 			//echo $value;
			//echo $currency;
			//var_dump($this->view);
		}elseif ($packageCat == "10"){
		    $str = $currenctFormat($value, $currency); // get Currency view helper 
		}
		return $str;
	}
	
	public function getServiceLocator(){
		return $this->serviceLocator;
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
}
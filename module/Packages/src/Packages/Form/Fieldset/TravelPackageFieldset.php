<?php
namespace Packages\Form\Fieldset;


use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Packages\Entity\TravelPackagesDetails;


class TravelPackageFieldset extends Fieldset implements InputFilterProviderInterface {
	
	
	private $entityManager;
	
	
	public function init(){
		$hydrator = new DoctrineObject($objectManager);
		$this->setHydrator($hydrator)->setObject(new TravelPackagesDetails());
		$this->addFeilds();
	}
	
	private function addFeilds(){
		$this->add(array(
				'name'=>'region',
				'type'=>'hidden',
		));
// 		$this->add(array(
// 				'name'=>'region',
// 				'type'=>'DoctrineModule\Form\Element\ObjectSelect',
// 				'options'=>array(
// 						'label' => 'Region',
// 						'object_manager' => $this->entityManager,
// 						'target_class' => 'Settings\Entity\TravelRegion',
// 						'property' => 'region',
// 						'empty_option' => '-- Select Region --',
// 						'label_attributes' => array (
// 								'class' => 'control-label col-md-3 col-sm-3 col-xs-12' ,
								
// 						) 
// 				), 
// 				'attributes'=>array(
// 						'class'=>"form-control col-md-9 col-xs-12",
// 						'required'=>"required"
// 				)
// 		));
		
// 		$this->add(array(
// 				'name'=>'duration',
// 				'type'=>'DoctrineModule\Form\Element\ObjectSelect',
// 				'options'=>array(
// 						'label' => 'Duration',
// 						'object_manager' => $this->entityManager,
// 						'target_class' => 'Settings\Entity\TravelDuration',
// 						'property' => 'duration',
// 						'empty_option' => '-- Select Duration --',
// 						'label_attributes' => array (
// 								'class' => 'control-label col-md-3 col-sm-3 col-xs-12' ,
								
// 						)
// 				),
// 				'attributes'=>array(
// 						'class'=>"form-control col-md-9 col-xs-12",
// 						'required'=>"required",
						
// 				)
// 		));
	}
	
	public function getInputFilterSpecification(){
		return array();
	}
	
	public function  setEntityManager($em){
		$this->entityManager = $em;
		return $this;
	}
	
}
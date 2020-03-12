<?php
namespace GeneralServicer\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use GeneralServicer\Entity\Document;

class LogoUploadFieldset extends Fieldset implements InputFilterProviderInterface{
	
	
	private $entityManager;
	
	public function init(){
		$hydrator = new DoctrineObject($this->entityManager);
		$this->setHydrator($hydrator)->setObject(new Document());
		$this->addFields();
	}
	
	private function addFields(){
		$this->add(array(
				'name'=>'docName',
				'type'=>'hidden'
		));
		
		$this->add(array(
				'name'=>'docUrl',
				'type'=>'',
		));
		
	}
	
	public function getInputFilterSpecification(){
		return array();
	}
	
	public function setEntityManager($em){
		$this->entityManager = $em;
		
		return $this;
	}
}
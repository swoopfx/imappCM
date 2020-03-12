<?php
namespace BrokersTool\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Customer\Entity\CustomerMessages;

class CustomerMessageFieldset extends Fieldset implements InputFilterProviderInterface {
	private $entityManager;
	public function init() {
		$hydrator = new DoctrineObject ( $this->entityManager );
		$this->setHydrator ( $hydrator )->setObject ( new CustomerMessages () );
	}
	private function addFields() {
		$this->add ( array (
				'name' => 'messageName',
				'type' => 'text',
				'options' => array (
						'label' => 'Message Title',
						'lable_attributes' => array (
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12' 
						) 
				),
				'attributes' => array (
						'id' => '',
						'placeholder' => 'Certificate Collection',
						'class' => 'form-control col-md-9 col-xs-12',
						'required' => 'required' 
				) 
		) );
		
		$this->add(array(
				'name'=>'content',
				'type'=>'textarea',
				'options'=>array(
						'label'=>'Message',
						'label_attributes'=>array(
								'class'=>'control-label col-md-3 col-sm-3 col-xs-12',
								
						)
				),
				'attributes'=>array(
						'class'=>'form-control col-md-9 col-xs-12',
						'required'=>'required'
						
				),
		));
	}
	public function getInputFilterSpecification() {
		return array ();
	}
	public function setEntityManager($em) {
		$this->entityManager = $em;
		return $this;
	}
}
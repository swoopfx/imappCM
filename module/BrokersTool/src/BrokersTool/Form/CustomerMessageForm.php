<?php
namespace BrokersTool\Form;

use Zend\Form\Form;

class CustomerMessageForm extends  Form{
	
	public function init(){
		
	}
	
	
	private function addFields(){
		$this->add(array(
				'name'=>'customerMessageFieldset',
				'type'=>'BrokersTool\Form\Fieldset\CustomerMessageFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));
		
	}
	private function addCommon(){
		
		$this->add(array(
				'name' => 'csrf',
				'type' => 'Zend\Form\Element\Csrf',
				'options' => array(
						'csrf_options' => array(
								'timeout' => 600
						)
				)
		));
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
						'class'=>'btn btn-primary',
						'value'=>'Create Staff',
						'type' => 'submit'
				)
		));
	}
}
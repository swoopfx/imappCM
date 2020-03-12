<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

class PackageBannerUploadForm extends Form{
	
	
	public function init(){
		$this->setAttributes(array(
				'method'=>'POST',
				'data-ajax-loader'=>"myLoader",
				'class'=>"form-horizontal form-label-left ajax_element",
		));
	}
	
	private function addFields(){
		$this->add(array());
	}
}
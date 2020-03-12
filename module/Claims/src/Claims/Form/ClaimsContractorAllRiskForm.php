<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsContractorAllRiskForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            'method'=>'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        
        $this->add(array(
            "name"=>"claimsContractorAllRisk",
            "type"=>"Claims\Form\Fieldset\ClaimsContractorAllRiskFieldset",
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Complete Claims',
                'class' => 'btn btn-success btn-block', // col-lg-offset-2
                //                 'id' => 'create-object'
            )
        ));
    }
}


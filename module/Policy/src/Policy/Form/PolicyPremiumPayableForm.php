<?php
namespace Policy\Form;

use Zend\Form\Form;

class PolicyPremiumPayableForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "action"=>""
        ));
        
        $this->add(array(
            "name"=>"policyPremiumPayableFieldset",
            "type"=>"Policy\Form\Fieldset\PolicyPremiumPayableFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Change Premium',
                'class' => 'btn btn-primary btn-block'
                
            )
        ));
        
    }
}


<?php
namespace Policy\Form;

use Zend\Form\Form;

class PolicyStatusForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "action"=>"",
        ));
        
        $this->add(array(
            "name"=>"policyStatusFieldset",
            "type"=>"Policy\Form\Fieldset\PolicyStatusFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Change Status',
                'class' => 'btn btn-primary btn-block'
                
            )
        ));
    }
}


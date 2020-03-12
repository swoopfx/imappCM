<?php
namespace Object\Form;

use Zend\Form\Form;

class ObjectPersonForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "class"=>"",
            "method"=>"POST"
        ));
        
        $this->add(array(
            'name' => "objectLifeFieldset",
            "type" => "Object\Form\Fieldset\ObjectPersonFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'COMPLETE',
                'class' => 'btn btn-lg btn-primary btn-block  btn-xs',
                'id' => 'create-object'
            )
        ));
    }
}


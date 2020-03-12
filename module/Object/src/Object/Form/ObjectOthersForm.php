<?php
namespace Object\Form;

use Zend\Form\Form;

class ObjectOthersForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "class"=>""
        ));
        
        $this->add(array(
            "name"=>'objectOthersFieldset',
            "type"=>"Object\Form\Fieldset\ObjectOthersFieldset",
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


<?php
namespace Object\Form;

use Zend\Form\Form;

class ObjectTravelForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            ""
        ));
        
        $this->add(array(
            "name"=>'objectTravelFieldset',
            "type"=>"Object\Form\Fieldset\ObjectTravelFieldset",
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


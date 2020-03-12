<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class MotorInsuranceForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "METHOD" => "POST",
            
            "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader"
        
        ));
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "motorinsuranceFieldset",
            "type" => "IMServices\Form\Fieldset\MotorInsuranceFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}


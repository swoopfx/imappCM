<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class WorkmenCompensationForm extends Form
{

    public function init(){
       
        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        
        $this->add(array(
            "name" => "workmenFieldset",
            "type" => "IMServices\Form\Fieldset\WorkmenCompensationFieldset",
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


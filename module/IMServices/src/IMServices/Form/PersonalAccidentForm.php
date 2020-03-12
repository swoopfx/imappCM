<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class PersonalAccidentForm extends Form
{

    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        
        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        
        $this->add(array(
            "name" => "personalAccidentFieldset",
            "type" => "IMServices\Form\Fieldset\PersonalAccidentFieldset",
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


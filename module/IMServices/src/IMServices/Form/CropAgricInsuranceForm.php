<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CropAgricInsuranceForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
//             "id" => "simpleForm",
            "class" => "form-horizontal form-label-left ajax_element",
            "data-ajax-loader" => "myLoader"
        ));
        
        $this->add(array(
            "name"=>"cropAgricInsuranceFieldset",
            "type"=>"IMServices\Form\Fieldset\CropInsuranceFieldset",
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


<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ProfessionalIndemnityPartnerDetailsForm extends Form
{

    public function init(){
        //
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));
        
        $this->add(array(
            "name" => "professionalIndemnityPartnerDetailsFieldset",
            "type" => "IMServices\Form\Fieldset\ProfessionalIndemnityParnerDetailsFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
               
                'value' => 'Add Details',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}


<?php
namespace Policy\Form;

use Zend\Form\Form;

class PolicySpecialTermsForm extends Form 
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "action" => ""
        ));
        $this->add(array(
            "name" => "policySpecialTermsFieldset",
            "type" => "Policy\Form\Fieldset\PolicySpecialTermsFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));

       

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Submit Terms',
                'class' => 'btn btn-primary btn-block'
            )
        ));
    }

   
}


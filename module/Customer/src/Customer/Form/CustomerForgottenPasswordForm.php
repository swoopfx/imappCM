<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CustomerForgottenPasswordForm extends Form
{
    
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "class"=>"form-horizontal form-label-left",
            "action"=>""
        ));
        
        $this->add(array(
            "name"=>"forgottenPasswordField",
            "type"=>"Customer\Form\Fieldset\CustomerForgotPasswordFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true,
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'SUBMIT',
                'class' => 'btn btn-primary btn-block',
                
            )
        ));
    }
}


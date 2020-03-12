<?php
namespace Policy\Form;

use Zend\Form\Form;

/**
 * THis class defines the form for renewal policy on the customer or broker page
 * @author otaba
 *        
 */
class RenewPolicyForm extends Form
{

   
    
    

    public function init(){
        $this->setAttributes(array(
            "action"=>"",
            "method"=>"POST",
            "class"=>"form-horizontal form-label-left ajax_element",
        ));
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"renewPolicyFeildset",
            "type"=>"Policy\Form\Fieldset\RenewPolicyFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Renew Policy',
                'class' => 'btn btn-primary btn-block'
                
            )
        ));
    }
}


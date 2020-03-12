<?php
namespace Policy\Form;

use Zend\Form\Form;

class PolicyRevokeForm extends Form
{

//     // TODO - Insert your code here
//     public function __construct()
//     {

//         // TODO - Insert your code here
//     }
    
    public function init(){
        
        $this->setAttributes(array(
            "class"=>"form-horizontal form-label-left ajax_element",
            "method"=>"POST",
            
            //'action' => "accountNameRequest",
            'data-ajax-loader' => "myLoader"
        ));
        
        
        $this->add(array(
            "name"=>"revokePolicyFieldset",
            "type"=>"Policy\Form\Fieldset\PolicyRevokeFieldset",
            "options"=>array(
                'use_as_base_fieldset' => true
            ),
        ));
        
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Revoke',
                'class' => 'btn btn-primary btn-block'
                
            )
        ));
    }
}


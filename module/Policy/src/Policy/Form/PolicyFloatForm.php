<?php
namespace Policy\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class PolicyFloatForm extends Form
{

    
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "action"=>"",
        ));
        
        $this->addFeild();
    }
    
    private function addFeild(){
        $this->add(array(
            "name"=>"policyFieldset",
            "type"=>"Policy\Form\Fieldset\PolicyFieldset",
            "options" => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        
       
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'Generate Policy',
                'class' => 'btn btn-primary btn-block'
                
            )
        ));
    }
}


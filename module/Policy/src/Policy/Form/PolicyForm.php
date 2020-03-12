<?php
namespace Policy\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class PolicyForm extends Form
{

    public function  init(){
        
        $this->setAttributes(array(
            "class"=>"form-horizontal form-label-left ajax_element",
            "method"=>"POST",
            
            //'action' => "accountNameRequest",
            'data-ajax-loader' => "myLoader"
        ));
        $this->addFields();
        $this->addCommon();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"policyFieldset",
            "type"=>"Policy\Form\Fieldset\PolicyFieldset",
            "options"=>array(
                'use_as_base_fieldset' => true
            ),
        ));
    }
    
    private function addCommon()
    {
        
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-success',
                'value' => 'Reset',
                'id' => 'reset'
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


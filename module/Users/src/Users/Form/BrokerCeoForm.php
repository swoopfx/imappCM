<?php
namespace Users\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class BrokerCeoForm extends Form
{
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "class"=>"form-horizontal form-label-left"
        ));
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"brokerCeoFieldset",
            "type"=>"Users\Form\Fieldset\BrokerCeoFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true,
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Create',
                'class' => 'btn btn-success btn-block',
                'id' => 'create-object'
            )
        ));
    }
}


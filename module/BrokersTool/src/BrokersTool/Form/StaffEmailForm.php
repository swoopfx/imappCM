<?php
namespace BrokersTool\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class StaffEmailForm extends Form
{

    
    
    public function init(){
        
        $this->setAttributes(array(
            "method"=>"POST"
        ));
        
        $this->add(array(
            "name"=>"staffEmailFieldset",
            "type"=>"BrokersTool\Form\Fieldset\StaffEmailFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'class'=>'btn btn-xs btn-primary btn-block',
                'value'=>'CHANGE',
                'type' => 'submit'
            )
        ));
    }
}


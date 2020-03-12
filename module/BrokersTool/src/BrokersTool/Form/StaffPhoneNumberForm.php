<?php
namespace BrokersTool\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class StaffPhoneNumberForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST"
        ));
        
        
        $this->add(array(
            "name"=>"staffPhoneFieldset",
            "type"=>"BrokersTool\Form\Fieldset\StaffPhoneNumberFieldset",
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


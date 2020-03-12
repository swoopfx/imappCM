<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsRejectedForm extends Form
{

    public function init(){
        
        $this->setAttributes(array(
            "method"=>"POST",
        ));
        
        $this->add(array(
            'name'=>'claimsRejectedFieldset',
            'type'=>'Claims\Form\Fieldset\ClaimsRejectedFieldset',
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Reject Claims',
                'class' => 'btn btn-success btn-block', // col-lg-offset-2
                'id' => 'create-object'
            )
        ));
        
    }
}


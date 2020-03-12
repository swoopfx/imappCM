<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsEmployerLiabilityForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST"
        ));
        
        $this->add(array(
            'name'=>'claimsEmployerLiabilityFieldset',
            'type'=>'Claims\Form\Fieldset\ClaimsEmployerLiabilityFieldset',
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Complete Claims',
                'class' => 'btn btn-success btn-block', // col-lg-offset-2
                //                 'id' => 'create-object'
            )
        ));
//         
    }
}


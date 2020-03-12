<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsMotorForm extends Form
{

   

    public function init()
    {
        $this->setAttributes(array(
//             'action'=>'',
            'method'=>'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        
       
        
        $this->add(array(
            'name'=>'claimsMotorFieldset',
            'type'=>'Claims\Form\Fieldset\ClaimsMotorAccidentFieldset',
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
    }
    

}


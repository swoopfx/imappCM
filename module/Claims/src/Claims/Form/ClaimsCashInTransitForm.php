<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsCashInTransitForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            'method'=>'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        
        $this->add(array(
            'name'=>'claimsCashInTransitFieldset',
            'type'=>'Claims\Form\Fieldset\ClaimsCashInTransitFiledset',
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


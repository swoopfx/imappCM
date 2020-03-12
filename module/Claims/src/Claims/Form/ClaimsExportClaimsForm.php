<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsExportClaimsForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            
        ));
        
        $this->add(array(
            "name"=>"exportEmailFieldset",
            "type"=>"Claims\Form\Fieldset\ClaimsExportClaimsFieldset",
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Export',
                'class' => 'btn btn-success btn-xs btn-block', // col-lg-offset-2
//                 'id' => 'create-object'
            )
        ));
    }
}


<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class OccupiersLiabilityForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "class"=>"form-horizontal form-label-left",
            "method"=>"POST"
        ));
        
        $this->addField();
    }
    
    private function addField()
    {
        $this->add(array(
            "name" => "occupiersLiabilityFieldset",
            "type" => "IMServices\Form\Fieldset\OccupiersLiabilityFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}


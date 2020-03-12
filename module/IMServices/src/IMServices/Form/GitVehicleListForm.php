<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class GitVehicleListForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "class"=>"form-horizontal form-label-left",
        ));
        
        $this->add(array(
            "name"=>"gitVehicleListFieldset",
            "type"=>"IMServices\Form\Fieldset\GitVehicleDetailsFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Add',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}


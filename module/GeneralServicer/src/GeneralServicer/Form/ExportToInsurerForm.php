<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ExportToInsurerForm extends Form
{

    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left",
            "autocomplete"=>"off"
        ));
        $this->add(array(
            "name" => "exportToInsurerFieldset",
            "type" => "GeneralServicer\Form\Fieldset\ExportToInsurerFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Export',
                'class' => 'btn btn-success btn-block'
            
            )
        ));
    }
}


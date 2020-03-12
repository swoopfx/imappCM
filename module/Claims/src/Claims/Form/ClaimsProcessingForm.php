<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsProcessingForm extends Form
{
    
   
        public function __construct($name = null, $options = null)
        {
            parent::__construct($name = null, $options = null);
            // TODO - Insert your code here
        
    }

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST"
        ));

        $this->add(array(
            "name" => "process",
            "type" => "select",
            "options" => array(
                "label" => "Claims Status",
                "labe_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
                "empty_option" => "Select Process",
                "value_options" => array(
                    "15" => "Declined/Canceled by insurer",
                    "74" => "Settled and Customer Paid",
                    "75" => "Settled and Customer Unpaid"
                )
            ),
            "attributes" => array(
                "id" => "process",
                "class" => "form-control col-xs-12",
                
                "required" => "required"
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Process',
                'class' => 'btn btn-success btn-block' // col-lg-offset-2
                                                       // 'id' => 'create-object'
            )
        ));
    }
}


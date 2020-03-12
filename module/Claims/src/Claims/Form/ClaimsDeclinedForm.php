<?php
namespace Claims\Form;

use Zend\Form\Form;

class ClaimsDeclinedForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
        ));
        
        $this->add(array(
            "name"=>"reason",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Decline Reason",
                "label_attributes"=>array(
                    "class"=>"",
                    
                ),
                
            ),
            "attributes"=>array(
                "id"=>"reason",
            )
        ));
    }
}


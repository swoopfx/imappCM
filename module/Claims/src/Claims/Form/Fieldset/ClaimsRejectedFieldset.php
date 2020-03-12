<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class ClaimsRejectedFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        $this->add(array(
            "type"=>"text",
            "name"=>"declineResason",
            "options"=>array(
                "label"=>"Rejection Reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "id"=>"declineResason",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "required"=>"required"
            ),
            
        ));
        
        $this->add(array(
            "type"=>"textarea",
            "name"=>"reasonDescription",
            "options"=>array(
                "label"=>"Reason Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "id"=>"reasonDescription",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
//                 "required"=>"required"
            ),
            
        ));
        
    }

    public function getInputFilterSpecification()
    {

        return array(
            "declineResason"=>array(
                "allow_empty"=>false,
                "required"=>true
            ),
            "reasonDescription"=>array(
                "allow_empty"=>false,
                "required"=>true
            ),
            
            
        );
    }
}


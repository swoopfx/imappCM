<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class ClaimsRejectFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        $this->add(array(
            "name"=>"declineResason",
            "type"=>"text",
            "options"=>array(
                "label"=>"Rejection reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"declineResason",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12", 
                "required"=>"required",
            )
        ));
        
        $this->add(array(
            "name"=>"reasonDescription",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Rejection reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"reasonDescription",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
//                 "required"=>"required",
            )
        ));
    }

    public function getInputFilterSpecification()
    {

        return array(
            "declineResason"=>array(
                "allow_empty"=>false,
                "required"=>true,
            ),
            "reasonDescription"=>array(
                "allow_empty"=>true,
                "required"=>false,
            )
        );
    }
}


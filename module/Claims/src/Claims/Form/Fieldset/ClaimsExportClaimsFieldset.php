<?php
namespace Claims\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ClaimsExportClaimsFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        $this->add(array(
            "name"=>"exportEmail",
            "type"=>"email",
            "options"=>array(
                "label"=>"Export Email",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"exportEmail",
                "required"=>"required"
            ),
        ));
    }
    public function getInputFilterSpecification()
    {
        return array();
    }

}


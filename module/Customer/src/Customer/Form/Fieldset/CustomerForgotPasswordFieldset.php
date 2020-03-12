<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class CustomerForgotPasswordFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"usernameoremail",
            "type"=>"text",
            "options"=>array(
                "label"=>"Phone Number or Email",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Phone Number or Email",
                "required"=>"required"
            )
        ));
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        return array();
    }
}


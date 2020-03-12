<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class CustomerPinCodeFieldset extends Fieldset implements InputFilterProviderInterface
{

   public function init(){
       $this->addFieldset();
   }
   
   private function addFieldset(){
       $this->add(array(
           "name"=>"pin",
           "type"=>"password",
           "options"=>array(
               "label"=>"PIN CODE"
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"pin",
               "required"=>"required",
               "style"=>" width: 100%",
               'maxlength'=>4,
               
               
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
        return array(
            "pincode"=>array(
                "required"=>true,
                "allow_empty"=>false,
                "filters"=>array(
                    
                ),
                "validators"=>array(
                    
                )
            )
        );
    }
}


<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class OTPForm extends Form implements InputFilterProviderInterface
{

   public function init(){
       $this->setAttributes(array(
           "action"=>"",
           "method"=>"POST",
       ));
       $this->addField();
   }
   
   private Function addField(){
       $this->add(array(
           "name"=>"otp",
           "type"=>"text",
           "options"=>array(
               "label"=>"One Time Password",
//                "label_attributes"=>array(
//                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
//                ),
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-9 col-xs-12",
               "id"=>"",
               "required"=>"required",
               "placeholder"=>"OTP"
           ),
       ));
       
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'CONFIRM PAYMENT',
               'class' => 'btn btn-primary btn-block',
               'id' => 'pay-now'
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
           "otp"=>array(
               "required"=>true,
               "allow_empty"=>false,
               "filters"=>array(
                   array(
                       'name' => 'Zend\Filter\StringTrim'
                   ),
                   array(
                       'name' => 'StripTags'
                   )
               ),
               "validators"=>array(),
           )
       );
    }
}


<?php
namespace GeneralServicer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class ExportToInsurerFieldset extends Fieldset implements InputFilterProviderInterface
{

   public function init(){
       $this->add(array(
           "name"=>"insurer1",
           "type"=>"email",
           "options"=>array(
               "label"=>"Insurer Email:",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-sm-9 col-md-9 col-xs-12",
               "id"=>"insurer1",
               "required"=>"required",
               "placeholder"=>"adc@xyz.com"
           )
       ));
       
       $this->add(array(
           "name"=>"insurer2",
           "type"=>"email",
           "options"=>array(
               "label"=>"Insurer Email:",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-sm-9 col-md-9 col-xs-12",
               "id"=>"insurer2",
               "placeholder"=>"adc@xyz.com"
               //"required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"insurer3",
           "type"=>"email",
           "options"=>array(
               "label"=>"Insurer Email:",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-sm-9 col-md-9 col-xs-12",
               "id"=>"insurer3",
               "placeholder"=>"adc@xyz.com"
               //"required"=>"required",
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
           "insurer3"=>array(
               "allow_empty"=>true,
               "required"=>false,
           ),
           "insurer2"=>array(
               "allow_empty"=>true,
               "required"=>false,
           ),
           "insurer1"=>array(
               "allow_empty"=>false,
               "required"=>true,
           ),
       );
    }
}


<?php
namespace IMServices\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class BoilerInsuranceForm extends Form
{

    // TODO - Insert your code here
    
   public function init(){
       $this->setAttributes(array(
           "method" => "POST",
           "class" => "form-horizontal form-label-left"
       ));
       $this->addFields();
   }
   
   private function addFields(){
//        $this->add
       $this->add(array(
           "name" => "boilerInsuranceFieldset",
           "type" => "IMServices\Form\Fieldset\BoilerInsuranceFieldset",
           'options' => array(
               'use_as_base_fieldset' => true
           )
       ));
       
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'Submit',
               'class' => 'btn btn-lg btn-primary btn-block'
           )
       ));
   }
}


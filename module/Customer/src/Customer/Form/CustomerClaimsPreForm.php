<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CustomerClaimsPreForm extends Form
{
    private $serviceManager;

   public function init(){
       $this->setAttributes(array(
           "method"=>"POST",
           'class' => 'form-horizontal form-label-left',
       ));
       $this->addField();
       $this->addCommon();
   }
   
   private function addField(){
       $this->add(array(
           'name' => 'pre_claims_field',
           'type' => 'Customer\Form\Fieldset\CustomerClaimsPreFieldset',
           'options'=>array(
               'use_as_base_fieldset'=>true,
           ),
          ));
   }
   
   private function addCommon()
   {
       
       
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'Start Claim',
               'class' => 'btn btn-primary btn-block btn-xs',
               
           )
       ));
   }
   
  
}


<?php
namespace Customer\Form;

use Zend\Form\Form;
use Zend\Form\Element\Checkbox;

/**
 *
 * @author swoopfx
 *        
 */
class ClientLoginForm extends Form
{
    
    
   public function init(){
       $this->setAttributes(array(
           'method'=>'POST',
           'action'=>'',
           'class'=>'form-horizontal',
           'novalidate'=>false
       ));
       $this->addFieldset();
       $this->addCommon();
       $this->addedval();
       
   }
   
   private function addFieldset(){
       $this->add(array(
           'name'=>'clientLoginField',
           'type'=>'Customer\Form\Fieldset\LoginFieldset',
           'options'=>array(
               'use_as_base_fieldset'=>true,
           ),
           
       ));
   }
   
   private function addedval(){
       $this->add(array(
           'name'=>'rememberme',
           'type'=>'Zend\Form\Element\Checkbox',
           'options'=>array(
               'label'=>'Remember Me'
           ),
           'attributes'=>array(
               'class'=>'rememberme'
           ),
       ));
   }
   
   private function addCommon()
   {
       $this->add(array(
           'name' => 'csrf',
           'type' => 'Zend\Form\Element\Csrf',
           'options' => array(
               'csrf_options' => array(
                   'timeout' => 1200
               )
           )
       ));
      
   
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'Login',
               'class' => 'btn btn-primary',
                
           )
       ));
   }
}


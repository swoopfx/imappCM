<?php
namespace Claims\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
   public function init(){
       $this->setAttributes(array(
           'action'=>'',
           'method'=>'POST',
           'class' => 'form-horizontal form-label-left'
       ));
       $this->addFields();
       $this->addCommon();
   }
   
   private function addFields(){
       $this->add(array(
           'name'=>'claimsFeildset',
           'type'=>'Claims\Form\Fieldset\ClaimsFieldset',
           'options'=>array(
               'use_as_base_fieldset'=>true
           ),
       ));
   }
   
   private function addCommon()
   {
//        $this->add(array(
//            'name' => 'csrf',
//            'type' => 'Zend\Form\Element\Csrf',
//            'options' => array(
//                'csrf_options' => array(
//                    'timeout' => 600
//                )
//            )
//        ));
   
       $this->add(array(
           'name' => 'reset',
           'type' => 'Zend\Form\Element',
           'options' => array(),
   
           'attributes' => array(
               'class' => 'btn btn-primary',
               'value' => 'Reset',
               'id' => 'reset'
           )
       ));
   
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'Complete Claims',
               'class' => 'btn btn-success btn-block', // col-lg-offset-2
               'id' => 'create-object'
           )
       ));
   }
}


<?php
namespace BrokersTool\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class AssignBrokerForm extends Form
{

   public function init(){
       $this->setAttributes(array(
           "method"=>"POST",
           'class' => 'form-horizontal form-label-left',
       ));
       $this->addFields();
       $this->addCommon();
   }
   public function addFields()
   {
       $this->add(array(
           'name' => 'assignBrokerFieldset',
           'type' => 'BrokersTool\Form\Fieldset\AssignBrokerFieldset',
           'options' => array(
               'use_as_base_fieldset' => true
           )
           
       ));
       //        $this->add(array(
       //             'name'=>'brokerChildProfile',
       //             'type'=>'BrokersTool\Form\Fieldset\BrokerChildProfileFieldset',
       
       
       //         ));
   }
   
   public function addCommon()
   {
       $this->add(array(
           'name' => 'csrf',
           'type' => 'Zend\Form\Element\Csrf',
           'options' => array(
               'csrf_options' => array(
                   'timeout' => 600
               )
           )
       ));
       
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'class'=>'btn btn-lg btn-primary btn-block',
               'value'=>'Assign Staff',
               'type' => 'submit'
           )
       ));
   }
}


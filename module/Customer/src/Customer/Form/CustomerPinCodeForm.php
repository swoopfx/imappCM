<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CustomerPinCodeForm extends Form
{

  public function init(){
      $this->add(array(
          "name"=>"pinCodeFieldset",
          "type"=>"Customer\Form\Fieldset\CustomerPinCodeFieldset",
          "options"=>array(
              "use_as_base_fieldset"=>true,
          ),
          
      ));
      
      $this->add(array(
          'name' => 'submit',
          'type' => 'Zend\Form\Element\Submit',
          'attributes' => array(
              'type' => 'submit',
              'value' => 'UPDATE PIN',
              'class' => 'btn btn-success block',
              "style"=>" width: 100%"
              
          )
      ));
  }
}


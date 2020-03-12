<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class AuthPaymentForm extends Form implements InputFilterProviderInterface
{

    public function init(){
        $this->setAttributes(array(
            "action"=>"",
            "method"=>"POST",
        ));
        $this->addFields();
    }
    
    private function addFields(){
       $this->add(array(
           "name"=>"auth",
           "type"=>"hidden",
           
       ));
       
       $this->add(array(
           'name' => 'cc_pin',
           'type' => 'password',
           'options' => array(
               'label' => 'Card Pin :'
               // 'label_attributes'=>array(
               // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
               // )
           ),
           'attributes' => array(
                'class'=>'form-control col-sm-8 col-md-8 col-xs-12',
               'id' => 'pin',
               'minlength'=>"3",
               'maxlength'=>"4",
               'required' => 'required',
                "placeholder" => "1234"
           )
       ));
       
       $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'type' => 'submit',
               'value' => 'PAY',
               'class' => 'btn btn-white btn-flat',
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
        
        // TODO - Insert your code here
    }
}


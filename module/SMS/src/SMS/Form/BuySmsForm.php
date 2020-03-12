<?php
namespace SMS\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class BuySmsForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addForm();
        $this->addCommon();
    }

    private function addForm()
    {
        $this->add(array(
            'name' => 'smsUnitFieldset',
            'type' => 'SMS\Form\Fieldset\SMSUnitFieldset',
            'options' => array(
                "use_as_base_fieldset"=>true
            )
        ));
        
        $this->add(array(
            'name' => 'card_payment',
            'type' => 'Transactions\Form\Fieldset\UserCardPaymentFieldset'
        ));
        
      
    }
    
    private function addCommon()
    {
        // $this->add(array(
        // 'name' => 'csrf',
        // 'type' => 'Zend\Form\Element\Csrf',
        // 'options' => array(
        // // 'csrf_options' => array(
        // // 'timeout' => 600
        // // )
        // )
        // ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
               
                'value' => 'BUY SMS',
                'class' => 'btn btn-block btn-success ',
                'id' => 'pay-now',
//                 'style'=>"width: 100%"
            )
        ));
    }
    
    // col-md-offset-6
}


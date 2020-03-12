<?php
namespace Transactions\Form;

use Zend\Form\Form;

class UserCardPaymentForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            'name' => 'user_card_payment_form',
            'action' => '',
            'method' => 'POST',
            
            'class' => 'form-horizontal form-label-left'
        
        ));
        $this->addField();
        
        $this->addCommon();
    }

    private function addField()
    {
        $this->add(array(
            'name' => 'card_payment',
            'type' => 'Transactions\Form\Fieldset\UserCardPaymentFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 1000
                )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'SEND PAYMENT',
                'class' => 'btn btn-primary btn-block',
                'id' => 'pay-nowe'
            )
        ));
    }
}


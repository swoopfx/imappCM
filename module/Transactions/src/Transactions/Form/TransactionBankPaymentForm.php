<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class TransactionBankPaymentForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
//             "action" => "",
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addField();
        $this->addCommon();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "bankPaymentFieldset",
            "type" => "Transactions\Form\Fieldset\TransactionBankPaymentFieldset",
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
                    'timeout' => 600
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

